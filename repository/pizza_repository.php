<?php
  require_once __DIR__ . '/../models/pizza_model.php';
  require_once __DIR__ . '/../config/database.php';

class PizzaRepository 
{
  private DatabaseConfig $databaseConfig;   

  public function __construct()
  {
    $this->databaseConfig = new DatabaseConfig();
  }

  /** @return array|mysqli_result|bool */
  private function executeQuery(mysqli $dbConnection, string $query)
  {
    # if db connection issue return error
    $connectionError = $dbConnection ? '' : mysqli_connect_error();
    if( $connectionError ) return [
      'error'=>true,
      'error_details'=>"DATABASE CONNECTION error: " . $connectionError
    ];

    # execute query
    $queryResult = mysqli_query($dbConnection, $query);

    # if query execution issue, return error
    if( !$queryResult ) { 
      return [
        'error'=>true, 
        'error_details'=>"DATABASE QUERY error: " . mysqli_error($dbConnection)
      ];
    }

    # success case
    return $queryResult;
  }

  /** @return PizzaModel[]|false */
  public function queryAll()
  {
    # OPEN db connection
    $dbConnection = $this->databaseConfig->connect();

    # define and run query
    $query = "SELECT * FROM pizzas";
    $queryResult = $this->executeQuery($dbConnection, $query);
    
    # if some error, return false
    if(is_array($queryResult) && $queryResult['error']){
      $this->databaseConfig->disconnect($dbConnection);
      return false;
    }

    # success case
    $allPizzas = [];
    $returnedPizzas = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
    mysqli_free_result($queryResult);
    
    foreach($returnedPizzas as $pizza){
      # create a new pizza model object
      $newPizza = new PizzaModel();

      # fill the new pizza model fields with current pizza values
      foreach($pizza as $key => $value){
        $newPizza->$key = $value;
      }

      # add the filled new pizza to $allPizzas
      $allPizzas[] = $newPizza;
    }

    # CLOSE db connection
    $this->databaseConfig->disconnect($dbConnection);

    return $allPizzas;
  }

  /** @return PizzaModel|false */
  public function queryById(int $id)
  {
    # OPEN db connection
    $dbConnection = $this->databaseConfig->connect();

    $query = "SELECT * FROM pizzas WHERE id = $id";
    $queryResult = $this->executeQuery($dbConnection, $query);

    # if some error, return false
    if(is_array($queryResult) && $queryResult['error']){
      $this->databaseConfig->disconnect($dbConnection);
      return false;
    }

    # not found case (return false)
    $returnedPizzaData = mysqli_fetch_assoc($queryResult);

    if(!$returnedPizzaData){
      mysqli_free_result($queryResult);
      $this->databaseConfig->disconnect($dbConnection);
      return false;
    }

    # success case -> fill a new pizza model with returned pizza values and return it
    $desiredPizza = new PizzaModel;
    foreach($returnedPizzaData as $field => $value){
      $desiredPizza->$field = $value;
    }

    # CLOSE db connection
    mysqli_free_result($queryResult);
    $this->databaseConfig->disconnect($dbConnection);

    return $desiredPizza;
  }

  /** @return bool */
  public function queryInsert(PizzaModel $newPizzaData)
  {
    # OPEN db connection
    $dbConnection = $this->databaseConfig->connect();

    # sanitize fields
    $safeSQL_email  = mysqli_real_escape_string($dbConnection, $newPizzaData->email);
    $safeSQL_title =  mysqli_real_escape_string($dbConnection, $newPizzaData->title);
    $safeSQL_ingredients =  mysqli_real_escape_string($dbConnection, $newPizzaData->ingredients);

    # query to create a new pizza
    $query = 
      "INSERT INTO pizzas (
        email,
        title,
        ingredients
      ) VALUES (
        '$safeSQL_email',
        '$safeSQL_title',
        '$safeSQL_ingredients'
      )";

    # execute query and return false if error
    $queryResult = $this->executeQuery($dbConnection, $query);

    if(is_array($queryResult) && $queryResult['error']){
      $this->databaseConfig->disconnect($dbConnection);
      return false;
    }

    # success case
    return true;
  }

  /** @return bool */
  public function queryUpdate(PizzaModel $pizza)
  {
    # OPEN db connection
    $dbConnection = $this->databaseConfig->connect();

    # sanitize fields
    $safeSQL_id = (int) $pizza->id;
    $safeSQL_email = mysqli_real_escape_string($dbConnection, $pizza->email);
    $safeSQL_title = mysqli_real_escape_string($dbConnection, $pizza->title);
    $safeSQL_ingredients = mysqli_real_escape_string($dbConnection, $pizza->ingredients);

    # query to update setting each field
    $query = 
    "UPDATE pizzas
      SET
        email = '$safeSQL_email',
        title = '$safeSQL_title',
        ingredients = '$safeSQL_ingredients'
      WHERE id = $safeSQL_id
    ";

    # execute query and return false if some error
    $queryResult = $this->executeQuery($dbConnection, $query);

    if(is_array($queryResult) && $queryResult['error']) {
      $this->databaseConfig->disconnect($dbConnection);
      return false;
    }

    # CLOSE db connection
    $this->databaseConfig->disconnect($dbConnection);

    # success case
    return true;
  }

  /** @return bool */
  public function queryDelete(int $id)
  {
    # verify pizza existance and return false if not
    $pizzaExists = $this->queryById($id);
    if( !$pizzaExists ) {
      return false;
    }

    # OPEN db connection
    $dbConnection = $this->databaseConfig->connect();

    # execute DELETE query and return false if some error
    $deleteQuery = "DELETE FROM pizzas WHERE id = $id";
    $deleteQueryResult = $this->executeQuery($dbConnection, $deleteQuery);
    
    if(is_array($deleteQueryResult) && $deleteQueryResult['error']) {
      $this->databaseConfig->disconnect($dbConnection);
      return false;
    }

    # CLOSE db connection
    $this->databaseConfig->disconnect($dbConnection);

    # success case
    return true;
  }
}
?>
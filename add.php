<?php
  # input values and errors storage
  $email = $title = $ingredients = '';
  $errors = [ 'email'=>'', 'title'=>'', 'ingredients'=>'' ];

  # functions for input fields validation
  function checkEmail(string $email){
    $passedFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
    if ( !$passedFilter ) return "Invalid email address";
  }

  function checkTitle(string $title){
    $passedFilter = preg_match('/^[a-zA-Z\s]+$/', $title);
    if ( !$passedFilter ) 
      return "Title must contain only lowercase letters, capital letters and spaces";
  }

  function checkIngredients(string $ingredients){
    $passedFilter = preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients);
    if( !$passedFilter ) 
      return "Ingredients must contain only lowercase letters, capital letters, spaces and be separated with commas";

    $explodedIngredients = explode(',', $ingredients);
    if ( count($explodedIngredients) < 3 ) 
      return "Ingredients list should have at least 3 items";
  }

  # form validation when it's submited
  if( isset($_POST['submit']) ){
    # these variables will store error messages if there is invalid inputs
    $invalidEmailError = checkEmail($_POST['email']);
    $invalidTitleError = checkTitle($_POST['title']);
    $invalidIngredientsError = checkIngredients($_POST['ingredients']);

    # if there is some error messages, save it inside $errors list
    if( $invalidEmailError ) $errors['email'] = $invalidEmailError;
    if ( $invalidTitleError ) $errors['title'] = "Invalid title. " . $invalidTitleError;
    if( $invalidIngredientsError ) $errors['ingredients'] = "Invalid ingredients. " . $invalidIngredientsError;

    # set input value as the $_POST request values (no need to retype to fix invalid inputs) 
    $email = $_POST['email'];
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];

    # if valid input values
    if( !array_filter($errors) ){
      # save the pizza on database
      require 'config/db_connect.php';
      $safeSQL_email = mysqli_real_escape_string($dbConnection, $email);
      $safeSQL_title = mysqli_real_escape_string($dbConnection, $title);
      $safeSQL_ingredients = mysqli_real_escape_string($dbConnection, $ingredients);

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
      
      $queryResult = mysqli_query($dbConnection, $query);
      if(!$queryResult) {
        echo "Query error: " . mysqli_error($dbConnection);
        return;
      }

      # if no query errors, redirect to '/' (pizzas list)
      header('Location: index.php');
    };
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    Add a Pizza - Pizza Index
  </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
  <?php require 'partials/header.php' ?>

  <div id="add-pizza">
    <h2>
      Add a Pizza
    </h2>

    <form action="add.php" method="POST">
      <!-- user email -->
      <div class="form-group">
        <label for="email">
          Your email:
        </label>
        <input 
          type="text" 
          name="email" 
          placeholder="your@email.com"
          value="<?php echo $email ?>"
        >

        <span class="error">
          <?php echo $errors['email'] ?>
        </span>
      </div>

      <!-- pizza title -->
      <div class="form-group">
        <label for="title">
          Pizza title:
        </label>
        <input 
          type="text" 
          name="title" 
          placeholder="Pepperoni Pizza"
          value="<?php echo $title ?>"  
        >

        <span class="error">
          <?php echo $errors['title'] ?>
        </span>
      </div>

      <!-- pizza ingredients -->
      <div class="form-group">
        <label for="ingredients">
          Pizza ingredients (comma separated, minimum of 3)
        </label>
        <input 
          type="text" 
          name="ingredients" 
          placeholder="Dough, Tomato Sauce, Cheese, Pepperoni..."
          value="<?php echo $ingredients ?>"
        >

        <span class="error">
          <?php echo $errors['ingredients'] ?>
        </span>
      </div>

      <!-- submit -->
      <div class="form-group">
        <input type="submit" name="submit" value="Submit">
      </div>
    </form>
  </div>

  <?php require 'partials/footer.php' ?>
</body>
</html>
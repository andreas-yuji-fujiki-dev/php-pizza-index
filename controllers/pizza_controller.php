<?php
  require_once __DIR__ . '/../models/pizza_model.php';
  require_once __DIR__ . '/../services/pizza_service.php';

  class Controller {
    public PizzaService $pizzaService;

    public function __construct()
    {
      $this->pizzaService = new PizzaService();
    }

    public function indexPage() 
    { 
      $pizzasList = $this->pizzaService->getAllPizzas();
      require __DIR__ . '/../views/index.php';
    }

    public function addPage()
    {
      # input values
      $email = $title = $ingredients = '';
      $errors = ['email' => '', 'title' => '', 'ingredients' => ''];
      
      # mounting the new pizza object when form is submited
      if( isset($_POST['submit']) ){
        $newPizza = new PizzaModel();
        
        $newPizza->email = $_POST['email'];
        $newPizza->title = $_POST['title'];
        $newPizza->ingredients = $_POST['ingredients'];

        $serviceResponse = $this->pizzaService->registerNewPizza($newPizza);
        
        /*
          service will return an associative array in case of errors, where each key represents errors from a input field
        */
        $returnedError = is_array($serviceResponse) && !empty(array_filter($serviceResponse));
        $errors = $returnedError ? $serviceResponse : null;

        # fill the inputs with the same values, user don't need to retype to fix inputs
        if( $returnedError ){
          $email = htmlspecialchars($_POST['email']);
          $title = htmlspecialchars($_POST['title']);
          $ingredients = htmlspecialchars($_POST['ingredients']);
        }

        # success case -> pizza has been created, then redirect to '/'
        if( !$returnedError ){
          header('Location: /');
          exit;
        }
      }

      require __DIR__ . '/../views/add.php';
    }

    public function detailsPage()
    {
      $specificPizza = null;

      if( isset($_GET['id']) ){
        $serviceResponse =  $this->pizzaService->getPizzaById($_GET['id']);
        if( $serviceResponse ) $specificPizza = $serviceResponse;
      }

      require __DIR__ . '/../views/details.php';
    }
  }
?>
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

      $showEditModal = false;
      $showDeleteModal = false;

      $deletionError = '';
      $editingError = '';

      // edit input values and individual edit input errors
      $editInput_newEmail = $editInput_newTitle = $editInput_newIngredients = '';
      $editInputErrors = [ 'email' => '', 'title' => '', 'ingredients' => ''];

      # get pizza details
      if( isset($_GET['id']) ){
        $serviceResponse = $this->pizzaService->getPizzaById($_GET['id']);

        if( $serviceResponse ){
            $specificPizza = $serviceResponse;
        }
      }

      /*  DELETE */

      # open DELETE modal
      if( isset($_POST['open-delete-modal']) ){
        $showDeleteModal = true;
      }

      # close DELETE modal
      if( isset($_POST['cancel-delete']) ){
        $showDeleteModal = false;
      }

      # DELETE pizza
      if( isset($_POST['confirm-delete']) ){
          $serviceResponse = $this->pizzaService->deletePizza($_POST['id-to-delete']);

          if( !$serviceResponse )
          {
            $deletionError =
                'We were unable to delete the pizza; please try reloading the page or try again later.';

            $showDeleteModal = true;
          }
          else {
            header('Location: /');
            exit;
          }
      }

      /*  EDIT */
      # open EDIT modal
      if( isset($_POST['open-edit-modal']) ){
          $showEditModal = true;

          # pre-fill inputs with current pizza data when opening the modal
          if( $specificPizza ){
              $editInput_newEmail = $specificPizza->email;
              $editInput_newTitle = $specificPizza->title;
              $editInput_newIngredients = $specificPizza->ingredients;
          }
      }

      # close EDIT modal
      if( isset($_POST['cancel-edit']) ){
          $showEditModal = false;
      }

      # EDIT pizza
      if( isset($_POST['confirm-edit']) ){
        # keep modal open while processing the request
        $showEditModal = true;

        # get submitted values
        $editInput_newEmail = $_POST['new-email'];
        $editInput_newTitle = $_POST['new-title'];
        $editInput_newIngredients = $_POST['new-ingredients'];

        # mount pizza update data
        $pizzaUpdateData = new PizzaModel();

        $pizzaUpdateData->id = $_POST['id-to-update'];
        $pizzaUpdateData->email = $editInput_newEmail;
        $pizzaUpdateData->title = $editInput_newTitle;
        $pizzaUpdateData->ingredients = $editInput_newIngredients;

        # send data to service
        $serviceResponse = $this->pizzaService->updatePizza($pizzaUpdateData);

        # if server return validation errors
        if( is_array($serviceResponse) && !empty(array_filter($serviceResponse)) )
            $editInputErrors = $serviceResponse;
        # success case
        else {
          header("Location: /details.php?id={$_POST['id-to-update']}");
          exit;
        }
      }

      require __DIR__ . '/../views/details.php';
    }
  }
?>
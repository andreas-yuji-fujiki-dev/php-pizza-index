<?php
  require_once __DIR__ . '/../models/pizza_model.php';
  require __DIR__ . '/../repository/pizza_repository.php';
  require __DIR__ . '/../utils/validate.php';

  class PizzaService {
    private PizzaRepository $pizzaRepository;
    private Validate $validate;

    public function __construct()
    {
      $this->pizzaRepository = new PizzaRepository;
      $this->validate = new Validate;
    }

    /** @return PizzaModel[]|false */
    public function getAllPizzas()
    {
      return $this->pizzaRepository->queryAll();
    }

    /** @return PizzaModel|false */
    public function getPizzaById(int $id){
      return $this->pizzaRepository->queryById($id);
    }

    /** @return true|array */
    public function registerNewPizza(PizzaModel $newPizzaData){
      # array to store errors for each input field
      $errors = $this->validate->allFormFields($newPizzaData); 

      # return errors if exists
      if( is_array($errors) && !empty(array_filter($errors)) )
        return $errors;

      # success case -> create the new pizza
      return $this->pizzaRepository->queryInsert($newPizzaData);
    }

    /** @return bool|array */
    public function updatePizza(PizzaModel $pizzaData){
      # array to store errors for each input field
      $errors = $this->validate->allFormFields($pizzaData);

      # return errors if exists
      if( !empty(array_filter($errors)) )
        return $errors;

      # success case -> update pizza
      return $this->pizzaRepository->queryUpdate($pizzaData);
    }

    /** @return bool */
    public function deletePizza(int $id){
      return $this->pizzaRepository->queryDelete($id);
    }
  }
?>
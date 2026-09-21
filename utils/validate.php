<?php
  require_once __DIR__ . '/../models/pizza_model.php';

  class Validate {
    /** @return boolean */
    public function userEmail(string $email){
      # accepts only valid email addresses
      $passedFilter = filter_var($email, FILTER_VALIDATE_EMAIL);
      if( !$passedFilter ) return 'Invalid email address';

      # success case
      return null;
    }

    /** @return boolean */
    public function pizzaTitle(string $title){
      # only accepts lowercase and uppercase letters from a to z and spaces
      $passedFilter = preg_match('/^[a-zA-Z\s]+$/', $title);
      if( !$passedFilter ) return 'Invalid title, use only letters and spaces';
      
      # success case
      return null;
    }

    /** @return boolean */
    public function pizzaIngredients(string $ingredients){
      # invalid cases: special characters, numbers, length lower than 3
      # ingredients should be a comma separated string, like: dough, tomato sauce, cheese, pepperoni 
      $passedStringFilter = preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients);
      $invalidLenght = count(explode(',', $ingredients)) < 3;

      if( !$passedStringFilter ) 
        return 'Invalid ingredients, use only letters, spaces and commas ( , )';
      
      if( $invalidLenght ) 
        return 'Invalid ingredients, add at least 3 ingredients';

      # valid case
      return null;
    }

    /** @return null|array */
    public function allFormFields(PizzaModel $pizzaData){
      # array to store errors for each input field
      $errors = [ 'email'=>'', 'title'=>'', 'ingredients'=>'' ];

      # if there is some error for a field, save it
      $invalidEmailError = $this->userEmail( $pizzaData->email );
      $invalidTitleError = $this->pizzaTitle( $pizzaData->title );
      $invalidIngredientsError = $this->pizzaIngredients( $pizzaData->ingredients );

      # if there is some error messages, save it inside $errors list
      if( $invalidEmailError ) $errors['email'] = $invalidEmailError;
      if ( $invalidTitleError ) $errors['title'] =  $invalidTitleError;
      if( $invalidIngredientsError ) $errors['ingredients'] =  $invalidIngredientsError;

      # return errors if exists
      if( !empty(array_filter($errors)) )
        return $errors;

      # no errors case
      return null;
    }
  }
?>
<?php
  $email = $title = $ingredients = '';
  $errors = [ 'email'=>'', 'title'=>'', 'ingredients'=>'' ];

  # functions to validate input fields
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

    $explodedIngredients = explode(',', $_POST['ingredients']);
    if ( count($explodedIngredients) < 3 ) 
      return "Ingredients list should have at least 3 items and contain only lowercase letters, capital letters and spaces";
  }

  # form validation
  if( isset($_POST['submit']) ){
    $invalidEmailError = checkEmail($_POST['email']);
    $invalidTitleError = checkTitle($_POST['title']);
    $invalidIngredientsError = checkIngredients($_POST['ingredients']);

    if( $invalidEmailError ) $errors['email'] = "Invalid email. " . $invalidEmailError;
    if ( $invalidTitleError ) $errors['title'] = "Invalid title. " . $invalidTitleError;
    if( $invalidIngredientsError ) $errors['ingredients'] = "Invalid ingredients. " . $invalidIngredientsError;

    $email = $_POST['email'];
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];

    if( !array_filter($errors) ) header('Location: index.php');
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
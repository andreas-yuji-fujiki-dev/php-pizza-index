<?php
  function checkEmail(string $email){
    $isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    if( !$isValidEmail )
      echo 'Invalid email address ';
  }

  function checkTitle(string $title){
    $isValidTitle = preg_match('/^[a-zA-Z\s]+$/', $title);
    
    if( !$isValidTitle )
      echo "Invalid title. Please use only lowercase letters, capital letters and spaces.";
  }

  function checkIngredients(string $ingredients){
    $isValidIngredients = preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients);
    if( !$isValidIngredients ){
      echo "Invalid ingredients. Please inform them separated by comma";
      return;
    }

    $explodedIngredients = explode(',', $ingredients);
    if ( count($explodedIngredients) < 3 )
      echo "Pizza ingredients list should have at least 3 items (example: dough, tomato sauce, cheese)";
  }

  # form validation
  if(isset($_POST['submit'])){
    checkEmail($_POST['email']);
    checkTitle($_POST['title']);
    checkIngredients($_POST['ingredients']);
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
        <input type="email" name="email" placeholder="your@email.com">
      </div>

      <!-- pizza title -->
      <div class="form-group">
        <label for="title">
          Pizza title:
        </label>
        <input type="text" name="title" placeholder="Pepperoni Pizza">
      </div>

      <!-- pizza ingredients -->
      <div class="form-group">
        <label for="ingredients">
          Pizza ingredients (comma separated, minimum of 3)
        </label>
        <input type="text" name="ingredients" placeholder="Dough, Tomato Sauce, Cheese, Pepperoni...">
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
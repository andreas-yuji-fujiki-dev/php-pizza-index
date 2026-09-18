<?php
  function checkEmail(string $email){
    # should not be empty
    if( empty($email) )
      echo 'An email is required <br/>';

    # should contain an `@` (at)
    if( !str_contains($email, "@") ){
      echo 'Email addresses must have an "@" (at) <br/>';
      return;
    }

    # separating user from domain
    $explodedEmail = explode('@', $email);
    $emailName = $explodedEmail[0]; # johndoe
    $emailDomain = $explodedEmail[1]; # gmail.com

    # user should exist
    if( empty($emailName) )
      echo "Invalid email user (->email.user.here<-@email.com) <br/>";

    # practice purposes only valid domains list
    $validEmailDomains = ['gmail.com', 'yahoo.com', 'outlook.com'];

    if( !in_array($emailDomain, $validEmailDomains))
      echo "Invalid email domain. For practice purposes, we only accept: gmail.com, yahoo.com and outlook.com emails <br/>";
  }

  function checkTitle(string $title){
    # should not be empty
    if( empty($title) ) 
      echo "Title should not be empty! <br/>";
  }

  function checkIngredients(array $ingredients){
    # should not be empty and should not have a length lower than 3
    if ( empty($ingredients) or count($ingredients) < 3 )
      echo 'Pizza ingredients list should have at least 3 items (for example: dough, tomato sauce, cheese)';
  }

  # form validation
  if(isset($_POST['submit'])){
    # check email
    checkEmail($_POST['email']);

    # check title
    checkTitle($_POST['title']);

    # check ingredients
    $arrayOfIngredients = explode(',', $_POST['ingredients']);
    checkIngredients($arrayOfIngredients);
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
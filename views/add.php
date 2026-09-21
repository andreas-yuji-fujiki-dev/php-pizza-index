<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    Add a Pizza - Pizza Index
  </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="/assets/css/styles.css">
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
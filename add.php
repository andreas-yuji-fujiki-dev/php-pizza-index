<?php
  if(isset($_GET)){
    echo $_GET['title'];
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

    <form action="add.php" method="GET">
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
          Pizza ingredients (comma separated)
        </label>
        <input type="text" name="ingredients" placeholder="Cheese, Tomato, Pepperoni...">
      </div>

      <!-- submit -->
      <div class="form-group">
        <input type="submit" value="submit">
      </div>
    </form>
  </div>

  <?php require 'partials/footer.php' ?>
</body>
</html>
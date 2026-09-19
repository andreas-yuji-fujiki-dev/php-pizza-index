<?php
  require('config/db_connect.php');

  $query = "SELECT id, title, ingredients FROM pizzas ORDER BY created_at";
  $queryResult = mysqli_query($dbConnection, $query);

  $pizzasList = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

  mysqli_free_result($queryResult);
  mysqli_close($dbConnection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    Pizza Index
  </title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="assets/css/styles.css?v16">
</head>
<body>
  <?php require 'partials/header.php' ?>

  <main id="main-content">
    <h2>
      Pizzas!
    </h2>

    <div class="pizzas-container">
      <?php foreach($pizzasList as $pizza){ ?>
        <div class="pizza-card">
          <img 
            src="https://placehold.co/200x200" 
            alt="<?php echo htmlspecialchars($pizza['title'])?> image"
          >

          <h3>
            <?php echo htmlspecialchars($pizza['title']) ?>
          </h3>

          <ul>
            <?php
              $explodedIngredients = explode(',', $pizza['ingredients']);

              foreach($explodedIngredients as $ingredient) {
            ?>
              <li>
                <?php echo htmlspecialchars($ingredient) ?>
              </li>
            <?php } ?>
          </ul>

          <footer>
            <button>
              More info
            </button>
          </footer>
        </div>
      <?php } ?>
    </div>
  </main>

  <?php require 'partials/footer.php' ?>
</body>
</html>
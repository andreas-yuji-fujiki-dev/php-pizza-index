<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    Pizza Index
  </title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
  <?php require __DIR__ . '/partials/header.php' ?>

  <main id="main-content">
    <h2>
      Pizzas!
    </h2>

    <!-- fallback for when $pizzasList is empty -->
    <?php if( !$pizzasList ): ?>
      <div class="no-pizzas-fallback">
        <span>
          There is no pizzas to display yet... <a href="/add.php">Create the first!</a>
        </span>
      </div>
    <?php endif ?>

    <!-- if $pizzasList is not empty, display the pizzas -->
    <?php if( count($pizzasList) >= 1): ?>

      <div class="pizzas-container">
        <?php foreach($pizzasList as $pizza): ?>
          <div class="pizza-card">
            <img 
              src="../assets/images/pizza.svg" 
              alt="<?php echo htmlspecialchars($pizza->title)?> image"
            >

            <h3>
              <?php echo htmlspecialchars($pizza->title) ?>
            </h3>

            <ul>
              <!-- each ingredient on a list item -->
              <?php foreach(explode(',', $pizza->ingredients) as $ingredient): ?>
                <li>
                  <?php echo htmlspecialchars($ingredient) ?>
                </li>
              <?php endforeach ?>
            </ul>

            <footer>
              <a href="/details.php/?id=<?php echo $pizza->id ?>">
                <button>
                  More info
                </button>
              </a>
            </footer>
          </div>
        <?php endforeach ?>
      </div>

    <?php endif ?>
  </main>

  <?php require __DIR__ . '/partials/footer.php' ?>
</body>
</html>
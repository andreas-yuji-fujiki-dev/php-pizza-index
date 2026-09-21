<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    Pizza Details
  </title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  
  <link rel="stylesheet" href="/assets/css/styles.css?v82">
</head>
<body>
  <?php require 'partials/header.php' ?>

  <div id="details">
    <h2>
      <?php
        if( empty($specificPizza) ) {
          echo 'Invalid pizza...';
        } else {
          echo $specificPizza->title;
        }
      ?>
    </h2>
    
    <?php
      $userName = explode('@', $specificPizza->email)[0];
      $email = $specificPizza->email;
      $ingredientsList = explode(',', $specificPizza->ingredients);
      
      $createdAt = $specificPizza->created_at;
      $createdAtDateTime = new DateTime($specificPizza->created_at);
      $now = new DateTime();
      $age = $createdAtDateTime->diff($now);

      if( !empty($specificPizza) ): 
    ?>
      <div class="about">
        <div class="details">
          <span class="created-by">
            Created by <span class="user-name"><?php echo $userName ?></span>: <?php echo $email ?>
          </span>
          <span class="creation-date">
            <span class="label">Created at:</span> <?php echo $createdAt ?>
          </span>
          <span class="age">
            <span class="label">Age:</span> <?php echo "{$age->y} years, {$age->m} months, {$age->d} days, {$age->h} hours, {$age->i} minutes, {$age->s} seconds"; ?>
          </span>
        </div>

        <div class="ingredients-container">
          <h3>
            Ingredients:
          </h3>

          <ul>
            <?php foreach($ingredientsList as $ingredient): ?>
              <li>
                <?php echo $ingredient ?>
              </li>
            <?php endforeach ?>
          </ul>
        </div>

        <div class="action-buttons">
          <button class="delete">
            Delete
          </button>

          <button class="edit">
            Edit
          </button>
        </div>
      </div>
    </div>
  <?php endif ?>

  <?php require 'partials/footer.php' ?>
</body>
</html>
<?php
  /** @var PizzaModel $specificPizza */
  /** @var bool $showEditModal */
  /** @var bool $showDeleteModal */
  /** @var string $deletionError */
  /** @var string $editingError */

  /** @var string $editInput_newEmail */
  /** @var string $editInput_newTitle */
  /** @var string $editInput_newIngredients */
  /** @var array $editInputErrors */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    Pizza Details
  </title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  
  <link rel="stylesheet" href="/assets/css/styles.css?v521">
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
      <!-- DELETE confirmation modal -->
      <?php if($showDeleteModal): ?>
        <div class="delete-confirm-backdrop"></div>
        <div class="delete-confirm-modal">
          <span class="confirmation">
            Are you sure? This cannot be undone!
          </span>
          <span class="pizza-to-delete">
            The pizza: <?php echo $specificPizza->title ?> will be deleted permanently
          </span>
          <form action="/details.php/?id=<?php echo $specificPizza->id?>" method="POST">
            <input type="hidden" name="id-to-delete" value="<?php echo $specificPizza->id ?>">
            <input type="submit" name="confirm-delete" value="DELETE">
            <input type="submit" name="cancel-delete" value="CANCEL">
          </form>

          <!-- error case -->
          <?php if($deletionError): ?>
            <span class="deletion-error">
              <?php echo $deletionError ?>
            </span>
          <?php endif ?>
        </div>
      <?php endif ?>

      <!-- EDIT modal -->
      <?php if($showEditModal): ?>
        <div class="edit-modal-backdrop"></div>
        <div class="edit-modal">
          <!-- title -->
          <span class="pizza-being-edited">
            Editing: <?php echo $specificPizza->title ?>
          </span>

          <!-- form -->
          <form action="/details.php/?id=<?php echo $specificPizza->id?>" method="POST">
            <!-- new email -->
            <div class="form-group">
              <label for="new-email">
                New email:
              </label>
              <input type="text" name="new-email" placeholder="yournew@email.com" value="<?php echo $editInput_newEmail ?>">
              <span class="input-error">
                <?php echo $editInputErrors['email'] ?>
              </span>
            </div>

            <!-- new title -->
            <div class="form-group">
              <label for="new-title">
                New title:
              </label>
              <input type="text" name="new-title" placeholder="Pepperoni Pizza" value="<?php echo $editInput_newTitle ?>">
              <span class="input-error">
                <?php echo $editInputErrors['title'] ?>
              </span>
            </div>

            <!-- new ingredients -->
            <div class="form-group">
              <label for="new-ingredients">
                New ingredients:
              </label>
              <input type="text" name="new-ingredients" placeholder="Dough, Tomato sauce, Cheese, Pepperoni" value="<?php echo $editInput_newIngredients ?>">
              <span class="input-error">
                <?php echo $editInputErrors['ingredients'] ?>
              </span>
            </div>

            <!-- action btns  -->
            <div class="action-buttons">
              <input type="hidden" name="id-to-update" value="<?php echo $specificPizza->id ?>">
              <input type="submit" name="cancel-edit" value="CANCEL">
              <input type="submit" name="confirm-edit" value="CONFIRM">
            </div>
          </form>

          <!-- error case -->
          <?php if($editingError): ?>
            <span class="edit-error">
              <?php echo $editingError ?>
            </span>
          <?php endif ?>
        </div>
      <?php endif ?>
        
      <!-- about pizza -->
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

        <!-- action buttons -->
        <div class="action-buttons">
          <form action="/details.php/?id=<?php echo $specificPizza->id?>" method="POST">
            <input type="submit" name="open-delete-modal" class="delete" value="Delete" />
            <input type="submit" name="open-edit-modal" class="edit" value="Edit" />
          </form>
        </div>
      </div>
    </div>
  <?php endif ?>

  <?php require 'partials/footer.php' ?>
</body>
</html>
<?php

require_once __DIR__ . '/../../config/database.php';

$pizzas = [
    [
        'id' => 1,
        'title' => 'Margherita',
        'ingredients' => 'Tomato sauce, mozzarella, fresh basil',
        'email' => 'margherita@pizzahouse.com',
        'created_at' => '2026-01-10 10:00:00'
    ],
    [
        'id' => 2,
        'title' => 'Pepperoni',
        'ingredients' => 'Tomato sauce, mozzarella, pepperoni',
        'email' => 'pepperoni@pizzahouse.com',
        'created_at' => '2026-01-10 10:05:00'
    ],
    [
        'id' => 3,
        'title' => 'Hawaiian',
        'ingredients' => 'Tomato sauce, mozzarella, ham, pineapple',
        'email' => 'hawaiian@pizzahouse.com',
        'created_at' => '2026-01-10 10:10:00'
    ],
    [
        'id' => 4,
        'title' => 'Four Cheese',
        'ingredients' => 'Mozzarella, provolone, parmesan, gorgonzola',
        'email' => 'fourcheese@pizzahouse.com',
        'created_at' => '2026-01-10 10:15:00'
    ],
    [
        'id' => 5,
        'title' => 'BBQ Chicken',
        'ingredients' => 'BBQ sauce, chicken, mozzarella, red onion',
        'email' => 'bbqchicken@pizzahouse.com',
        'created_at' => '2026-01-10 10:20:00'
    ],
    [
        'id' => 6,
        'title' => 'Meat Lovers',
        'ingredients' => 'Tomato sauce, mozzarella, pepperoni, sausage, bacon, ham',
        'email' => 'meatlovers@pizzahouse.com',
        'created_at' => '2026-01-10 10:25:00'
    ],
    [
        'id' => 7,
        'title' => 'Vegetarian',
        'ingredients' => 'Tomato sauce, mozzarella, mushrooms, bell peppers, onions, olives',
        'email' => 'vegetarian@pizzahouse.com',
        'created_at' => '2026-01-10 10:30:00'
    ],
    [
        'id' => 8,
        'title' => 'Supreme',
        'ingredients' => 'Tomato sauce, mozzarella, pepperoni, sausage, mushrooms, onions, bell peppers',
        'email' => 'supreme@pizzahouse.com',
        'created_at' => '2026-01-10 10:35:00'
    ],
    [
        'id' => 9,
        'title' => 'Buffalo Chicken',
        'ingredients' => 'Buffalo sauce, chicken, mozzarella, ranch dressing',
        'email' => 'buffalochicken@pizzahouse.com',
        'created_at' => '2026-01-10 10:40:00'
    ],
    [
        'id' => 10,
        'title' => 'Mushroom',
        'ingredients' => 'Tomato sauce, mozzarella, mushrooms, garlic, oregano',
        'email' => 'mushroom@pizzahouse.com',
        'created_at' => '2026-01-10 10:45:00'
    ],
    [
        'id' => 11,
        'title' => 'Bacon & Egg',
        'ingredients' => 'Tomato sauce, mozzarella, bacon, egg, onions',
        'email' => 'baconegg@pizzahouse.com',
        'created_at' => '2026-01-10 10:50:00'
    ],
    [
        'id' => 12,
        'title' => 'Spicy Chicken',
        'ingredients' => 'Tomato sauce, mozzarella, chicken, jalapeños, red onion',
        'email' => 'spicychicken@pizzahouse.com',
        'created_at' => '2026-01-10 10:55:00'
    ],
    [
        'id' => 13,
        'title' => 'Garlic & Cheese',
        'ingredients' => 'Mozzarella, parmesan, roasted garlic, oregano',
        'email' => 'garliccheese@pizzahouse.com',
        'created_at' => '2026-01-10 11:00:00'
    ],
    [
        'id' => 14,
        'title' => 'Ham & Mushroom',
        'ingredients' => 'Tomato sauce, mozzarella, ham, mushrooms',
        'email' => 'hammushroom@pizzahouse.com',
        'created_at' => '2026-01-10 11:05:00'
    ],
    [
        'id' => 15,
        'title' => 'Tuna',
        'ingredients' => 'Tomato sauce, mozzarella, tuna, onions, olives',
        'email' => 'tuna@pizzahouse.com',
        'created_at' => '2026-01-10 11:10:00'
    ],
    [
        'id' => 16,
        'title' => 'Prosciutto',
        'ingredients' => 'Tomato sauce, mozzarella, prosciutto, arugula',
        'email' => 'prosciutto@pizzahouse.com',
        'created_at' => '2026-01-10 11:15:00'
    ],
    [
        'id' => 17,
        'title' => 'Pesto Chicken',
        'ingredients' => 'Pesto sauce, chicken, mozzarella, cherry tomatoes',
        'email' => 'pestochicken@pizzahouse.com',
        'created_at' => '2026-01-10 11:20:00'
    ],
    [
        'id' => 18,
        'title' => 'Buffalo Bacon',
        'ingredients' => 'Buffalo sauce, mozzarella, bacon, chicken, jalapeños',
        'email' => 'buffalobacon@pizzahouse.com',
        'created_at' => '2026-01-10 11:25:00'
    ],
    [
        'id' => 19,
        'title' => 'Chicken Alfredo',
        'ingredients' => 'Alfredo sauce, chicken, mozzarella, parmesan',
        'email' => 'chickenalfredo@pizzahouse.com',
        'created_at' => '2026-01-10 11:30:00'
    ],
    [
        'id' => 20,
        'title' => 'Sausage & Peppers',
        'ingredients' => 'Tomato sauce, mozzarella, Italian sausage, bell peppers, onions',
        'email' => 'sausagepeppers@pizzahouse.com',
        'created_at' => '2026-01-10 11:35:00'
    ],
    [
        'id' => 21,
        'title' => 'Italian',
        'ingredients' => 'Tomato sauce, mozzarella, Italian sausage, mushrooms, olives',
        'email' => 'italian@pizzahouse.com',
        'created_at' => '2026-01-10 11:40:00'
    ],
    [
        'id' => 22,
        'title' => 'Mediterranean',
        'ingredients' => 'Mozzarella, feta cheese, olives, tomatoes, spinach, red onion',
        'email' => 'mediterranean@pizzahouse.com',
        'created_at' => '2026-01-10 11:45:00'
    ],
    [
        'id' => 23,
        'title' => 'Spinach & Ricotta',
        'ingredients' => 'Mozzarella, ricotta, spinach, garlic, parmesan',
        'email' => 'spinachricotta@pizzahouse.com',
        'created_at' => '2026-01-10 11:50:00'
    ],
    [
        'id' => 24,
        'title' => 'Philly Cheesesteak',
        'ingredients' => 'Mozzarella, beef, onions, bell peppers, mushrooms',
        'email' => 'phillycheesesteak@pizzahouse.com',
        'created_at' => '2026-01-10 11:55:00'
    ],
    [
        'id' => 25,
        'title' => 'Cheeseburger',
        'ingredients' => 'Mozzarella, ground beef, cheddar, onions, pickles, special sauce',
        'email' => 'cheeseburger@pizzahouse.com',
        'created_at' => '2026-01-10 12:00:00'
    ],
    [
        'id' => 26,
        'title' => 'Truffle Mushroom',
        'ingredients' => 'Mozzarella, mushrooms, truffle oil, parmesan',
        'email' => 'trufflemushroom@pizzahouse.com',
        'created_at' => '2026-01-10 12:05:00'
    ],
    [
        'id' => 27,
        'title' => 'Buffalo Ranch',
        'ingredients' => 'Buffalo sauce, mozzarella, chicken, bacon, ranch dressing',
        'email' => 'buffaloranch@pizzahouse.com',
        'created_at' => '2026-01-10 12:10:00'
    ],
    [
        'id' => 28,
        'title' => 'Garlic Shrimp',
        'ingredients' => 'Tomato sauce, mozzarella, shrimp, roasted garlic, parsley',
        'email' => 'garlicshrimp@pizzahouse.com',
        'created_at' => '2026-01-10 12:15:00'
    ],
    [
        'id' => 29,
        'title' => 'Pesto Veggie',
        'ingredients' => 'Pesto sauce, mozzarella, zucchini, bell peppers, tomatoes',
        'email' => 'pestoveggie@pizzahouse.com',
        'created_at' => '2026-01-10 12:20:00'
    ],
    [
        'id' => 30,
        'title' => 'Caramelized Onion',
        'ingredients' => 'Mozzarella, caramelized onions, goat cheese, balsamic glaze',
        'email' => 'caramelizedonion@pizzahouse.com',
        'created_at' => '2026-01-10 12:25:00'
    ],
    [
        'id' => 31,
        'title' => 'Chicken Bacon Ranch',
        'ingredients' => 'Ranch sauce, chicken, bacon, mozzarella, cheddar',
        'email' => 'chickenbaconranch@pizzahouse.com',
        'created_at' => '2026-01-10 12:30:00'
    ],
    [
        'id' => 32,
        'title' => 'BBQ Pulled Pork',
        'ingredients' => 'BBQ sauce, pulled pork, mozzarella, red onion, pickles',
        'email' => 'bbqpulledpork@pizzahouse.com',
        'created_at' => '2026-01-10 12:35:00'
    ],
    [
        'id' => 33,
        'title' => 'Mexican',
        'ingredients' => 'Tomato sauce, mozzarella, ground beef, jalapeños, corn, onions',
        'email' => 'mexican@pizzahouse.com',
        'created_at' => '2026-01-10 12:40:00'
    ],
    [
        'id' => 34,
        'title' => 'Mediterranean Chicken',
        'ingredients' => 'Mozzarella, chicken, feta cheese, olives, tomatoes, spinach',
        'email' => 'mediterraneanchicken@pizzahouse.com',
        'created_at' => '2026-01-10 12:45:00'
    ],
    [
        'id' => 35,
        'title' => 'Five Cheese',
        'ingredients' => 'Mozzarella, cheddar, provolone, parmesan, gorgonzola',
        'email' => 'fivecheese@pizzahouse.com',
        'created_at' => '2026-01-10 12:50:00'
    ],
    [
        'id' => 36,
        'title' => 'Garden Fresh',
        'ingredients' => 'Tomato sauce, mozzarella, tomatoes, mushrooms, spinach, bell peppers',
        'email' => 'gardenfresh@pizzahouse.com',
        'created_at' => '2026-01-10 12:55:00'
    ],
    [
        'id' => 37,
        'title' => 'Smoked Bacon',
        'ingredients' => 'Tomato sauce, mozzarella, smoked bacon, caramelized onions',
        'email' => 'smokedbacon@pizzahouse.com',
        'created_at' => '2026-01-10 13:00:00'
    ],
    [
        'id' => 38,
        'title' => 'Roasted Chicken',
        'ingredients' => 'Tomato sauce, mozzarella, roasted chicken, garlic, mushrooms',
        'email' => 'roastedchicken@pizzahouse.com',
        'created_at' => '2026-01-10 13:05:00'
    ],
    [
        'id' => 39,
        'title' => 'Classic Cheese',
        'ingredients' => 'Tomato sauce, mozzarella, cheddar, oregano',
        'email' => 'classiccheese@pizzahouse.com',
        'created_at' => '2026-01-10 13:10:00'
    ],
    [
        'id' => 40,
        'title' => 'House Special',
        'ingredients' => 'Tomato sauce, mozzarella, pepperoni, sausage, bacon, mushrooms, onions',
        'email' => 'housespecial@pizzahouse.com',
        'created_at' => '2026-01-10 13:15:00'
    ],
];

$sql = "
    INSERT IGNORE INTO pizzas
        (id, title, ingredients, email, created_at)
    VALUES
        (?, ?, ?, ?, ?)
";

$databaseConfig = new DatabaseConfig();

# connecting to database
$dbConnection = $databaseConfig->connect();

# fill a pizza model with pizza data for each item on the list
# then, save it on database
foreach ($pizzas as $pizza) {
    $query = "
        INSERT IGNORE INTO pizzas (
            id, 
            title, 
            ingredients, 
            email, 
            created_at
        ) VALUES (
            '{$pizza['id']}',
            '{$pizza['title']}', 
            '{$pizza['ingredients']}', 
            '{$pizza['email']}', 
            '{$pizza['created_at']}'
        )
    ";

    mysqli_query($dbConnection, $query);
}

# disconnecting from database
$databaseConfig->disconnect($dbConnection);

echo "Pizzas seeded successfully!\n";
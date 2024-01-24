<?php

    require_once(__DIR__ . "/../index.php");


    $allDishes = Dish::getAll($connection);
    foreach ($allDishes as $dish) {
        echo "ID: {$dish['idDish']}, Name: {$dish['nameDish']}, Author: {$dish['author']}<br>";
    }




?>

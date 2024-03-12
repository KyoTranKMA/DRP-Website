<?php namespace App\Models;


// use autoload from composer



require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');
class RecipeModel extends BaseModel {
    private $id;
    private $name;
    private $description;
    private $image_url;
    private $preparation_time;
    private $cooking_time;
    private $direction;
    private $meal_type_1;
    private $meal_type_2;
    private $meal_type_3;

    const TABLE = 'Recipes';


}

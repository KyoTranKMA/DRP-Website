<?php 
namespace App\Controllers;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');

class IngredientController extends BaseController
{
    public function index() {
        require_once(VIEWS_PATH . 'ingredient/list_ingredients.php');
    }
}

$a = new IngredientController();
$a->index();
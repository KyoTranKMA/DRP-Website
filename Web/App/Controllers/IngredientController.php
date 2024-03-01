<?php 
namespace App\Controllers;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class IngredientController extends BaseController
{
    public function index()
    {
        return $this->loadView('ingredients.index');
    }

}

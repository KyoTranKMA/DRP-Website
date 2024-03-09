<?php 
namespace App\Controllers;

use App\Core\SampleTest;
use App\Models\IngredientModel;

// use autoload from composer
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');

class IngredientController extends BaseController
{
    public function index() {
        return $this->loadView('pages.index');
    }

    public function listAll() {
        $ingredients = IngredientModel::getAll();
        return $this->loadView('ingredient.list_all', $ingredients);
    }
    public function addUI() {
        return $this->loadView('ingredient.add');
    }
    public function add() {
        $data = $_POST;
        IngredientModel::create('ingredients', $data);
        header("Location: /ingredient");
    }
}
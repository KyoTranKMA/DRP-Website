<?php 
namespace App\Controllers;
use App\Models\RecipeModel;
use App\Operations\RecipeReadOperation;
use App\Operations\RecipeCreateOperation;
use App\Operations\RecipeUpdateOperation;
use App\Operations\RecipeDeleteOperation;

// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class RecipeController extends BaseController 
{
    public function index() {
        $recipes = RecipeReadOperation::getAllObjects();
        $this->loadView('recipe.recipe_view', $recipes);
    }
    public function findByID()
    {
        $id = $_GET('id');  
        $this->loadView('recipe.recipe_view', $id);
    }
    public function addUI() {
        $this->loadView('recipe.add');
    }
    public function add() {
        $data = $_POST;
        RecipeCreateOperation::execute($data);
        header("Location: /recipe/add");
    }
    public function editUI() {
        $id = $_GET['id'];
        $recipe = RecipeReadOperation::getSingleObjectById($id);
        $this->loadView('recipe.edit', $recipe);
    }

    public function edit() {
        $data = $_POST;
        RecipeUpdateOperation::execute($data);
        header("Location: /recipe/edit?id=" . $data['id']);
    }
    public function deleteUI() {
        $id = $_GET['id'];
        $recipe = RecipeReadOperation::getSingleObjectById($id);
        $this->loadView('recipe.delete', $recipe);
    }

    public function delete() {
        $id = $_GET['id'];
        RecipeDeleteOperation::deleteById($id);
        header("Location: /recipe");
    }
}

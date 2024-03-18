<?php

namespace App\Controllers;

use App\Operations\RecipeReadOperation;
use App\Operations\RecipeCreateOperation;
use App\Operations\RecipeUpdateOperation;
use App\Operations\RecipeDeleteOperation;
use App\Operations\IngredientReadOperation;
use App\Operations\UploadImageOperation;


// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class RecipeController extends BaseController
{

    public function viewDetail(){
        // $recipe = $_GET['id']; 
        // $data = RecipeReadOperation::getSingleObjectById($recipe);
        return $this->loadView('recipe.recipe_detail');
    } 
    public function index()
    {
        $recipes = RecipeReadOperation::getAllObjects();
        $this->loadView('recipe.recipe', $recipes);
    }
    public function findByID()
    {
        $id = $_GET('id');
        $recipe = RecipeReadOperation::getSingleObjectById($id);
        $this->loadView('recipe.recipe_view', $recipe);
    }
    public function listByCategory()
    {
        $category = $_GET['category'];
        $recipes = RecipeReadOperation::getAllObjectsByFieldAndValue('category', $category);
        $this->loadView('recipe.recipe', $recipes);
    }
    public function addUI()
    {
        $data = IngredientReadOperation::getIdAndNameAllObject();
        $this->loadView('recipe.add', $data);
    }
    public function add() {   
        $data = $_POST;
        
        echo "<pr> data: ";
        var_dump($data);
        echo "</pre>";
        $data['image_url'] = UploadImageOperation::process();
        RecipeCreateOperation::execute($data);
        header("Location: /recipe/add");
    }

    public function editUI()
    {
        $id = $_GET['id'];
        $recipe = RecipeReadOperation::getSingleObjectById($id);
        $this->loadView('recipe.edit', $recipe);
    }
    public function edit()
    {
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
    public function search()
    {
        $recipes = RecipeReadOperation::getAllObjectsByFieldAndValue('name', $_POST['name']);
        $this->loadView('recipe.recipe', $recipes,);
    }



}

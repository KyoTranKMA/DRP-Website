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

    public function index()
    {
        $this->loadView('recipe.recipe');
    }

    public function viewDetail()
    {
        $id = $_GET['id'];
        $recipe = RecipeReadOperation::getSingleObjectById($id);
        $this->loadViewWithOtherExtract('recipe.recipe_detail', $recipe);
    }

    public function findByID()
    {
        $id = $_GET['id'];
        $recipe = RecipeReadOperation::getSingleObjectById($id);
        $this->loadView('recipe.recipe_view', $recipe);
    }
    public function search(){
        $recipes = RecipeReadOperation::getAllObjectsByFieldAndValue('name', $_GET['id']);
        $this->loadView('recipe.recipe', $recipes);

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
        try {
        $data = $_POST;

        $ingredientComponents = [];
        for ($index = 0; $index < count($data['ingredient_id']); $index++) {
            $component = [
                'ingredient_id' => $data['ingredient_id'][$index],
                'unit' => $data['unit'][$index],
                'quantity' => $data['quantity'][$index]
            ];
            $ingredientComponents[] = $component;
        }
        
        $data['ingredientComponents'] = $ingredientComponents;
        unset($data['ingredient_id']);
        unset($data['unit']);
        unset($data['quantity']);

        $data['image_url'] = UploadImageOperation::process();
        if ($data['image_url'] == null) {
            echo "<script>alert('Failed to upload image.');</script>";
            header("Location: /recipe/add");
            exit();
        }
        
        if (RecipeCreateOperation::execute($data))
            header("Location: /recipe/add");
    } catch (\PDOException $PDOException) {
        handlePDOException($PDOException);
        header("Location: /recipe/add");
        echo "<script>alert('Failed to add recipe.');</script>";
    }
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
    public function deleteUI()
    {
        $id = $_GET['id'];
        $recipe = RecipeReadOperation::getSingleObjectById($id);
        $this->loadView('recipe.delete', $recipe);
    }

    public function delete()
    {
        $id = $_GET['id'];
        RecipeDeleteOperation::deleteById($id);
        header("Location: /recipe");
    }
    public function find() {    
        $this->loadView('recipe.find');
    }

    public function findResult(){
        $id = $_GET['id'] ?? null;

        $recipe = RecipeReadOperation::getSingleObjectById($id);
        $this->loadView('recipe.recipe', $recipe);
    }
}

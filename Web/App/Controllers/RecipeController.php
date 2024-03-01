<?php 
namespace App\Controllers;
use App\Models\RecipeModel;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class RecipeController extends BaseController 
{
    private $RecipeModel;
    // Get Path Class Recipe Model;
    public function __construct()
    {
        $this->RecipeModel = new RecipeModel();
    } 
    public function index()
    {
        $Recipes = $this->RecipeModel->getAll();
        return $this->loadView('pages.Recipepage', $Recipes);
    }
    public function show()
    {
        $id = $_GET('id');  
        $Recipe = $this->RecipeModel->findById($id);
        echo $Recipe;
    }

    public function update()
    {
        $id = $_GET('id');
        $data = ['name' => 'test'];
        $this->RecipeModel->updateById($id, $data);
    }
    public function delete()
    {
        $id = $_GET('id');
        $this->RecipeModel->deleteById($id);
    }


}

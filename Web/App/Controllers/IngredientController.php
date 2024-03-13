<?php 
namespace App\Controllers;
use App\Operations\IngredientReadOperation;
use App\Operations\IngredientCreateOperation;
use App\Operations\IngredientUpdateOperation;

// use autoload from composer
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');

class IngredientController extends BaseController
{
    public function index() {
        return $this->loadView('pages.homepage');
    }

    public function listAll() {
        $ingredients = IngredientReadOperation::getAllObjects();
        return $this->loadView('ingredient.list_all', $ingredients);
    }
    public function listByCategory() {
        // $category = 'OTHR';
        // $ingredients = IngredientReadOperation::getAllObjectsByFieldAndValue('category', $category);
        // return $this->loadView('ingredient.list_all', $ingredients);
        $name = 'lemon juice'; 
        $ingredients = IngredientReadOperation::getAllObjectsByFieldAndValue('name', $name);
        if(! $ingredients == null) 
            return $this->loadView('ingredient.list_all', $ingredients);
        else
            echo \App\Views\ViewRender::errorViewRender('410');
    }
    public function listByCategoryWithOffset() {
        $category = $_GET['category'];
        $offset = $_GET['offset'];
        $limit = $_GET['limit'];
        $ingredients = IngredientReadOperation::getObjectWithOffsetByFielAndValue('category', $category, $offset, $limit);
        if ($ingredients == null) {
            echo \App\Views\ViewRender::errorViewRender('410');
        }
        else
            return $this->loadView('ingredient.list_all', $ingredients);
    }
    
    public function addUI() {
        return $this->loadView('ingredient.add');
    }
    public function add() {
        $data = $_POST;
        IngredientCreateOperation::execute($data);
        header("Location: /ingredient/add");
    }

    public function editUI() {
        // $this->loadView('ingredient.find_by_name_form');
        // list danh sách các nguyên liệu hoac tim kiem nguyen lieu theo ten nguyen lieu
        // view nhap ten nguyen lieu va hien ra cac ket qua tim kiem
        // sau khi chon nguyen lieu can sua thi chuyen den trang sua nguyen lieu dua tren id
        // $data = $_POST['name'];
        // $ingredients = IngredientReadOperation::getAllObjectsByFieldAndValue('name', $data);
        // if(!isset($ingredients)) 
        //     echo \App\Views\ViewRender::errorViewRender('410'); 
        // else $this->loadView('ingredient.select_edit', $ingredients);
        // $id = $_GET['id'];
        // $ingredient = IngredientReadOperation::getSingleObjectById($id);
        $ingredient = IngredientReadOperation::getSingleObjectById(1);
        $data[] = $ingredient; 
        return $this->loadView('ingredient.update', $data);
    }

    public function edit() {
        $data = $_POST;
        IngredientUpdateOperation::execute($data);
        header("Location: /ingredient/editUI");
    }
}
<?php 
namespace App\Controllers;
use App\Models\DishModel;
class DishController extends BaseController 
{
    private $dishModel;
    // Get Path Class Dish Model;
    public function __construct()
    {
        $this->dishModel = new DishModel();
    } 
    public function index()
    {
        $dishs = $this->dishModel->getAll();
        return $this->loadView('pages.dishpage', $dishs);
    }
    public function show()
    {
        $id = $_GET('id');  
        $dish = $this->dishModel->findById($id);
        echo $dish;
    }

    public function update()
    {
        $id = $_GET('id');
        $data = ['name' => 'test'];
        $this->dishModel->updateById($id, $data);
    }
    public function delete()
    {
        $id = $_GET('id');
        $this->dishModel->deleteById($id);
    }


}

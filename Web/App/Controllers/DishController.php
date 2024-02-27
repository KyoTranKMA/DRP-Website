<?php


class DishController extends BaseController 
{
    private $dishModel;
    // Get Path Class Dish Model;
    public function __construct()
    {
        $this->loadModel('DishModel');
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



}

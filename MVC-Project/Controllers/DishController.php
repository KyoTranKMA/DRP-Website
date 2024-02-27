<?php


class DishController extends BaseController 
{
    private $conn;
    // Get Path Class Dish Model;
    public function __construct()
    {
        $this->loadModel('DishModel');
        $dbManager = DatabaseController::getInstance();
        $this->conn = $dbManager->getConnection();
    } 
    public function index()
    {
        $title = 'Cac mon an buoi sang: ';
        $dishs = [
            [
                'id' => 1,
                'name' => 'Cơm Tấm'
            ],
            [
                'id' => 2,
                'name' => 'Bánh Mì'
            ],    
            [
                'id' => 3,
                'name' => 'Phở'
            ],

        ]; 
        $dishModel = new DishModel();

        return $this->loadView('frontend.pages.dishpage', [
            'title' => $title
            ,'dishs' => $dishs
        ]);
    }
    public function show()
    {
        $dishModel = new DishModel;
        echo $dishModel->getByID($this->conn, 1); 

    }



}

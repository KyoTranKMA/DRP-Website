<?php namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController{
    public function userAccount(){
        $users = UserModel::getAllUser();
        return $this->loadView('admin.index', ['users' => $users]);
    }    

    public function setLevel(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])){
            $data = $_POST;
            UserModel::setLevel($data);
            header("Location: /manager/user");
        }
    }
}
?>
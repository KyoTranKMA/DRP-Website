<?php namespace App\Controllers;

use App\Models\UserModel;

class AdminController extends BaseController{
    public function userAccount(){
        $users = UserModel::getAllUser();
        return $this->loadView('admin.index', ['users' => $users]);
    }    
}
?>
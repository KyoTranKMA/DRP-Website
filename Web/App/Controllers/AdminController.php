<?php namespace App\Controllers;

use App\Core\Router;
use App\Models\UserModel;

class AdminController extends BaseController{
    public function index(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }
        return $this->loadView('admin.index');
    }

    // User
    public function userManager(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }
        
        if($_GET['s_id'] != ''){ 
            $users = UserModel::getUserById($_GET['s_id']);
        } else if($_GET['s_username'] != ''){
            $users = UserModel::getUserByUsername($_GET['s_username']);
        } else if ($_GET['s_email'] != ''){
            $users = UserModel::getUserByEmail($_GET['s_email']);
        }
        
        if(!$users){
            $users = UserModel::getAllUser();
        }
        $users = UserModel::getAllUser();
        return $this->loadView('admin.user', ['users' => $users]);
    }    
    
    public function userManagerUpdateUI(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }
        $users = UserOperation::getUserById($_GET['id']);
        return $this->loadView('admin.userUpdate', ['user' => $users]);
    }

    public function userManagerUpdate(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }
        $data = $_POST;
        UserOperation::update($data);
        header("Location: /manager/user");
    }

    public function userManagerAdd(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }
        $data = $_POST;
        
        if (UserOperation::checkEmail($data['email'])) {
            echo '<script>
            alert("Email already exist!");
            window.location.href = "/manager/user";
            </script>';
        }else if (UserOperation::checkUserName($data['username'])){
            echo '<script>
            alert("Username Already Existed");
            window.location.href = "/manager/user";
            </script>';
        }else if(UserOperation::addUser($data)){
            echo '<script>
                alert("Register Success!");
                window.location.href = "/manager/user";
            </script>';
            exit();
        } else {
            echo '<script>
                alert("Register Fail!, Please try again!");
                window.location.href = "/manager/user";
            </script>';
            exit();
        }

        header("Location: /manager/user");
    }

    public function setLevel(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])){
            $data = $_POST;
            UserOperation::setLevel($data);
            header("Location: /manager/user");
        }
    }

    private function isAdmin(){
        return isset($_SESSION['level']) && $_SESSION['level'] == 1;
    }
    
    /*
    Quản lý recipe
    */
    public function recipeManager(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }

        $recipes = RecipeReadOperation::getAllObjects();
        return $this->loadView('admin.recipe', ['recipes' => $recipes]);
    }
}
?>
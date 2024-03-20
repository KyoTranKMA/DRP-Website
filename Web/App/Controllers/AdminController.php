<?php namespace App\Controllers;

use App\Operations\IngredientReadOperation;
use App\Operations\UserOperation;
use App\Operations\RecipeReadOperation;
use App\Operations\RecipeUpdateOperation;

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
            $users = UserOperation::getUserById($_GET['s_id']);
        } else if($_GET['s_username'] != ''){
            $users = UserOperation::getUserByUsername($_GET['s_username']);
        } else if ($_GET['s_email'] != ''){
            $users = UserOperation::getUserByEmail($_GET['s_email']);
        }
        if(!$users){
            $users = UserOperation::getAllUser();
        }

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

    public function setUserLevel(){
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

    public function recipeManagerUpdateUI(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }

        $recipe = RecipeReadOperation::getSingleObjectById($_GET['id']);
        return $this->loadView('admin.recipeUpdate', ['recipe' => $recipe]);
    }

    public function recipeManagerUpdate(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }
        $data = $_POST;
        RecipeUpdateOperation::execute($data);
        header("Location: /manager/recipe");
    }

    /*
        Quản lý ingredient
    */
    public function ingredientManager(){
        if(!$this->isAdmin()){
            return parent::loadError('404');
        }

        $ingredients = IngredientReadOperation::getAllObjects();
        return $this->loadView('admin.ingredient', ['ingredients' => $ingredients]);
    }
}
?>
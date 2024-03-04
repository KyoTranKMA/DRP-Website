<?php 
namespace App\Controllers;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
use App\Models\UserModel;

class UserController extends BaseController
{
    private $userModel;
    // Get Path Class User Model;
    public function __construct()
    {
        $this->userModel = new UserModel();
    } 

    public function index()
    {
    }

    public function login(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
            $this->userModel = $this->userModel->authenticate($_POST);
            if($this->userModel)
            {   
                session_regenerate_id(true);
                $_SESSION['logged_in'] = true;
                header("Location: LoginController.php");
                exit();
            }
        }
    }

    public static function logout(){
        if(ini_get("session.use_cookie")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), 
                '', 
                time() - 42000, 
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }

    public function registery(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registery'])){
            $this->userModel->addUser($_POST);
        }
        $this->login();
    }

    public function isLoggedIn(){
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
    }
}


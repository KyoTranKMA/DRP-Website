<?php 
namespace App\Controllers\Auth;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    // Get Path Class User Model;
    public function __construct()
    {
    } 

    public function index()
    {
    }

    public static function login(){
        $userModel = new UserModel;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
            $userModel = $userModel->authenticate($_POST);
            if($userModel)
            {   
                session_regenerate_id(true);
                $_SESSION['logged_in'] = true;
                $_SESSION['level'] = $userModel->level;
                die($_SESSION['level']);
                header("Location: /App/Controllers/Auth/LoginController.php");
                exit();
            }
        }
    }

    public static function logout(){
        // Kiểm tra xem session có tồn tại không
        if(session_status() === PHP_SESSION_ACTIVE) {
            // Hủy toàn bộ session
            session_destroy();

            // Xóa cookie session nếu được sử dụng
            if(ini_get("session.use_cookies")) {
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
        }
    }

    public static function registery(){
        $userModel = new UserModel;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registery'])){
            $userModel->addUser($_POST);
        }
        UserController::login();
    }

    public static function isLoggedIn(){
        return isset($_SESSION) && isset($_SESSION['logged_in']);
    }
}


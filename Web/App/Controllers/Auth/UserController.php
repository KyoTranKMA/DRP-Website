<?php 
namespace App\Controllers\Auth;
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');
use App\Controllers\BaseController;
use App\Controllers\HomeController;
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
            if($userModel){   
                $_SESSION['logged_in'] = true;
                header("Location: /App/Controllers/Auth/LoginController.php");
                exit();
            } else {
                HomeController::loadView('auth.404');
            }
        }
    }

    public static function logout(){
        // Kiểm tra xem session có tồn tại không
        if(session_status() === PHP_SESSION_ACTIVE) {
            // Hủy toàn bộ session
            session_unset();
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


<?php 
namespace App\Controllers;
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');
use App\Controllers\BaseController;
use App\Controllers\HomeController;
use App\Models\UserModel;

class UserController extends BaseController
{
    // Get Path Class User Model;
    public function loginUI()
    {
        return $this->loadView('auth.login');
    }

    public function login(){
        $data = $_POST;
        $errors = [];

        if ($data['username'] == ''){
            $errors['username'] = "Please enter your name login!";
        }
        if ($data['password'] == ''){
            $errors['password'] = "Please enter your password!";
        }
        if ($errors){
            return $this->loadView('auth.login', $errors);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
            $userModel = UserModel::authenticate($data);
            if($userModel){   
                $_SESSION['logged_in'] = true;
                header("Location: /index");
                exit();
            } else {
                echo \App\Views\ViewRender::errorViewRender('404');
            }
        }
    }

    public function registeryUI()
    {
        return $this->loadView('auth.login');
    }

    public function registery(){
        $userModel = new UserModel;
        $data = $_POST;
        $errors = [];

        if ($data['email'] == ''){
            $errors['email'] = "Please enter your email!";
        } else if ($userModel->checkEmail($data['email'])) {
            $errors['email'] = 'Email Already Existed';
        }
        if ($data['username'] == ''){
            $errors['username'] = "Please enter your name login!";
        } else if ($userModel->checkUserName($data['username'])) {
            $errors['username'] = 'Username Already Existed';
        }
        if ($data['password'] == ''){
            $errors['password'] = "Please enter your password!";
        }
        if ($data['repassword'] == ''){
            $errors['repassword'] = "Please enter your re-password!";
        } else if ($data['repassword'] != $data['password'] ){
            $errors['repassword'] = "Passwords do not match!";
        }
        if ($errors){
            return $this->loadView('auth.login', $errors);
        }

        UserModel::addUser($data);
        header("Location: /index");
    }

    public function logout(){
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
        header("Location: /index");
    }

    public static function isLoggedIn(){
        return isset($_SESSION) && isset($_SESSION['logged_in']);
    }
}


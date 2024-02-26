<?php
class UserController extends BaseController
{
    private static $userModel = new UserModel;
    // Get Path Class User Model;
    public function __construct()
    {
        $this->loadModel('UserModel');
    } 

    public function index()
    {
        // Get Path Class User
        //$this->userModel = new UserModel;
        
    }

    public function login(){
        /*
            Form đăng nhập của BT đang để là email
        */
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            if (DatabaseController::getInstance()){
                // Chung thuc user
                $rs = UserModel::authenticate(DatabaseController::getInstance(), $_POST);
                if ($rs){
                    $_SESSION['email'] = $email;
                    /*header("Location: index.php");
                    exit();*/
                } else {
                    // Báo lỗi login
                    //echo "Invalid Username or password";
                }
            }
        }
    }

    public function register(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])){
            if (DatabaseController::getInstance()){
                $rs = $this->userModel->addUser(DatabaseController::getInstance(), $_POST);
            }
        }
    }
}
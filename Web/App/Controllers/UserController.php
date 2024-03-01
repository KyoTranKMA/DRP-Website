<?php 
namespace App\Controllers;
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
        $email = $_POST('email');
        $password = $_POST('password');
        $users = $this->userModel->authenticate([$email, $password]);
        if($users)
        {
            return $this->loadView('pages.homepaage', $users);
        }
    }

    public function login(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $rs = $this->userModel->authenticate($_POST);
            if ($rs){
                $_SESSION['email'] = $email;
                /*header("Location: index.php");
                exit();*/
            } else {
                // Báo lỗi login
                echo "Invalid Username or password";
            }
            }
    }

    public function register(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])){
        $rs = $this->userModel->addUser($_POST);
        }
    }

}


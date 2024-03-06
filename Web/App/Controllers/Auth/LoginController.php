<?php namespace App\Controllers\Auth;

    require($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');

    if (!UserController::isLoggedIn()){
        UserController::login();
    } else {
        if ($_SESSION['level'] == 1){
            header("Location: /App/Views/admin/index.html");
        } else {
            die("login");
            header("Location: /App/Views/auth/homepage.php");
        }
    }
?>
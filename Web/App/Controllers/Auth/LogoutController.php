<?php
    namespace App\Controllers\Auth;
    require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

    if (UserController::isLoggedIn()){
        UserController::logout();
    }

    header("Location: /App/Views/auth/homepage.php");
?>
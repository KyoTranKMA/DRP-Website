<?php
    namespace App\Controllers;
    require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

    $userController = new UserController;

    if ($userController->isLoggedIn()){
        $userController->logout();
    }

    header("Location: /App/Views/auth/index.php");
?>
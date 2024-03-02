<?php namespace App\Controllers;

    require($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');

    $userController = new UserController;

    if (!$userController->isLoggedIn()){
        $userController->login();
    }

    if ($_SESSION['level'] == 1){
        header("Location: ./../Views/admin/index.html");
    } else {
        header("Location: ./../Views/auth/homepage.php");
    }
?>
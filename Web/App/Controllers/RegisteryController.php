<?php namespace App\Controllers;
    require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

    $userController = new UserController;

    $userController->registery();
?>
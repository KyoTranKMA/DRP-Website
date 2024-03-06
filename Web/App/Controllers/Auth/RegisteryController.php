<?php namespace App\Controllers\Auth;

use App\Controllers\HomeController;

    require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');

    UserController::registery();

    HomeController::homePage();
?>
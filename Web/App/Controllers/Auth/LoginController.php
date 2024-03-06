<?php namespace App\Controllers\Auth;

use App\Controllers\HomeController;

    require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
    
    if (!UserController::isLoggedIn()){
        UserController::login();
    } 

    if ($_SESSION['level'] == 1){
        HomeController::admin();
    } else {
        HomeController::homePage();
    }
?>
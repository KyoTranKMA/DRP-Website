<?php

use App\Controllers\HomeController;

    require($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');
    HomeController::homePage();

    /*
    // Get Route name and Validate Param
    $controllerName = $_REQUEST['controller'] ?? 'Home';
    echo json_encode($controllerName);
    $actionName = $_REQUEST['action'] ?? 'index';
    if(class_exists('App\Controllers\\' . $controllerName) == false) {
        die('Controller not found');
    }
    $fullController = "App\Controllers\\$controllerName";
    
    // Generate Object  
    $controllerObject = new $fullController;
    // Get Method
    $controllerObject->$actionName();
    */
?>
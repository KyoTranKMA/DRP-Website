<?php
    namespace App; 
    use App\Controllers\HomeController;
    require_once(__DIR__ . '/Core/init.php');

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

?>
<?php

    require_once(__DIR__ . '/Core/init.php');
    // require_once(__DIR__ . '/Core/Database.php');
    // require_once(__DIR__ . '/Models/BaseModel.php');
    // require_once(__DIR__ . '/Controllers/BaseController.php');

    // Get Route name and Validate Param
    $controllerName = ucfirst(strtolower($_REQUEST[('controller')]) . 'Controller');
    $actionName = $_REQUEST['action'] ?? 'index';
    $fullPathController = "App\Controllers\\$controllerName";
    // require_once(__DIR__ . "/Controllers/$controllerName.php");
    
    // Generate Object  
    $controllerObject = new $fullPathController;
    // Get Method
    $controllerObject->$actionName();
    

    

?>
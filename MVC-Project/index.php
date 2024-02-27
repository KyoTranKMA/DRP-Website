<?php


    // Get Route name and Validate Param
    $controllerName = ucfirst(strtolower($_REQUEST[('controller')]) . 'Controller');
    $actionName = $_REQUEST['action'] ?? 'index';
    require_once(__DIR__ . "/Controllers/$controllerName.php");
 
    // Generate Object
    $controllerObject = new $controllerName;
    // Get Method
    $controllerObject->$actionName();
?>
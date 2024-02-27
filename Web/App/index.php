<?php

    require_once(__DIR__ . '/inc/init.php');
    require_once(__DIR__ . '/Core/Database.php');
    require_once(__DIR__ . '/Models/BaseModel.php');
   
    $db = new DataBase;
    $db->getConnection();
    $model = new BaseModel();
    $model->getConnection();

    

?>
<?php

use App\Controllers\UserController;

require("./../UserController.php");

$userController = new UserController;
$userController->login();

?>
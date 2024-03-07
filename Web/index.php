<?php

use App\Controllers\Auth\UserController;
use App\Core\Router;

require_once($_SERVER['DOCUMENT_ROOT'] . "/App/Core/init.php");

$router = new Router;
$router->get('/user','UserController@index');
$router->get('/user/login','UserController@loginUI');
$router->post('/user/login','UserController@login');
$router->get('/user/registery','UserController@registeryUI');
$router->post('/user/registery','UserController@registery');
$router->get('/user/logout','UserController@logout');
$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>
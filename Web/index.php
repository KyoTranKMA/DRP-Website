<?php

use App\Controllers\Auth\UserController;
use App\Core\Router;

require_once($_SERVER['DOCUMENT_ROOT'] . "/App/Core/init.php");

$router = new Router;

// user router
$router->get('/user','UserController@index');
$router->get('/user/login','UserController@loginUI');
$router->post('/user/login','UserController@login');
$router->get('/user/registery','UserController@registeryUI');
$router->post('/user/registery','UserController@registery');
$router->get('/user/logout','UserController@logout');
// $router->get('/user/profile','UserController@profile');
// $router->get('/user/edit','UserController@editUI');
// $router->post('/user/edit','UserController@edit');

// ingredient router
$router->get('/ingredient','IngredientController@index');
$router->get('/ingredient/list','IngredientController@listAll');
$router->get('/ingredient/add','IngredientController@addUI');
$router->post('/ingredient/add','IngredientController@add');
$router->get('/ingredient/edit','IngredientController@editUI');
$router->post('/ingredient/edit','IngredientController@edit');
$router->get('/ingredient/delete','IngredientController@delete');

// recipe router
$router->get('/recipe','RecipeController@index');
$router->get('/recipe/list','RecipeController@list_all');
$router->get('/recipe/add','RecipeController@addUI');
$router->post('/recipe/add','RecipeController@add');
$router->get('/recipe/edit','RecipeController@editUI');
$router->post('/recipe/edit','RecipeController@edit');
$router->get('/recipe/delete','RecipeController@delete');
$router->get('/recipe/show','RecipeController@show');
$router->get('/recipe/search','RecipeController@search');

$router->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>
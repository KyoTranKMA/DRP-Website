<?php

// homepage router
$router->get('/index', 'HomeController@homePage');
$router->get('/homepage', 'HomeController@homePage');

// user router
$router->get('/login','UserController@loginUI');
$router->post('/login','UserController@login');
$router->get('/registery','UserController@registeryUI');
$router->post('/registery','UserController@registery');
$router->get('/logout','UserController@logout');
// $router->get('/user/profile','UserController@profile');
// $router->get('/user/edit','UserController@editUI');
// $router->post('/user/edit','UserController@edit');

// admin router
$router->get('/manager/user', 'AdminController@userAccount');
$router->get('/manager/recipe', 'AdminController@recipeManager');
$router->get('/manager/ingredient', 'AdminController@ingredientsManager');
$router->get('/manager/recipe/add', 'AdminController@addRecipeUI');

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
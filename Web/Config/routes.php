<?php

// homepage router
$router->get('/', 'HomeController@homePage');
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
$router->post('/manager/user/setLevel', 'AdminController@setLevel');
$router->get('/manager/recipe', 'AdminController@recipeManager');
$router->get('/manager/ingredient', 'AdminController@ingredientsManager');
$router->get('/manager/recipe/add', 'AdminController@addRecipeUI');

// ingredient router
$router->get('/ingredient','IngredientController@index');
$router->get('/ingredient/find-by-id','IngredientController@findByID');
$router->get('/ingredient/list','IngredientController@listAll');
$router->get('/ingredient/list-by-category','IngredientController@listByCategory');
$router->get('/ingredient/add','IngredientController@addUI');
$router->post('/ingredient/add','IngredientController@add');
$router->get('/ingredient/find','IngredientController@findByName');
$router->get('/ingredient/edit','IngredientController@editUI');
$router->post('/ingredient/edit','IngredientController@edit');
$router->get('/ingredient/delete','IngredientController@delete');

// recipe router

$router->get('/recipe','RecipeController@index');
$router->get('/recipe/find-by-id','RecipeController@findByID');
$router->get('/recipe/list','RecipeController@listByName');
$router->get('/recipe/list-by-category','RecipeController@listByCategory');
$router->get('/recipe/add','RecipeController@addUI');
$router->post('/recipe/add','RecipeController@add');
// $router->get('/recipe/add','RecipeController@addUI');
// $router->post('/recipe/add','RecipeController@add');
// $router->get('/recipe/edit','RecipeController@editUI');
// $router->post('/recipe/edit','RecipeController@edit');
// $router->post('/recipe/delete','RecipeController@delete');
$router->get('/recipe/search','RecipeController@search');
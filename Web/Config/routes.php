<?php
const App = '/App';

$router->get(App . '/index.php', 'HomeController@index');
$router->get(App . '/index.php/cong-thuc', 'RecipeController@index');
$router->get(App . '/index.php/thanh-phan', 'IngredientController@index');

$router->get(App . '/index.php/login', 'Auth\\LoginController@show');

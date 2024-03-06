<?php
const App = '/App';

$router->get(App . '/index.php', 'HomeController@index');
$router->get(App . '/cong-thuc', 'RecipeController@index');

<?php
const App = '/App';


/* Action mặc định (index) -> Mục đích từ index trong Controller gọi đến Views trả về giao diện khi người dùng gọi đến URI bên dưới */
$router->get(App . '/index.php', 'HomeController@index');
$router->get(App . '/trang-chu', 'HomeController@homePage');
$router->get(App . '/cong-thuc', 'RecipeController@index');
$router->get(App . '/thanh-phan', 'IngredientController@index');
$router->get(App . '/upload', 'UploadController@index');

$router->get(App . '/user','UserController@index');
$router->get(App . '/user/login','UserController@loginUI');
$router->get(App . '/user/registery','UserController@registeryUI');
$router->get(App . '/user/logout','UserController@logout');
$router->get(App . '/manager/user', 'Admin@userAccount');
$router->get(App . '/manager/recipe', 'Admin@recipeManager');
$router->get(App . '/manager/ingredient', 'Admin@ingredientsManager');


/* Action đăng ký */
$router->post('/user/login','UserController@login');
$router->post('/user/registery','UserController@registery');



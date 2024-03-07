<?php



const App = '/App';


/* Action mặc định (index) -> Mục đích từ index trong Controller gọi đến Views trả về giao diện khi người dùng gọi đến URI bên dưới */
$router->get(App . '/index.php', 'HomeController@index');
$router->get(App . '/trang-chu', 'HomeController@homePage');
$router->get(App . '/cong-thuc', 'RecipeController@index');
$router->get(App . '/thanh-phan', 'IngredientController@index');
$router->get(App . '/upload', 'UploadController@index');

$router->get(App . '/dang-nhap', 'Auth\\LoginController@index');
$router->get(App . '/dang-ky', 'Auth\\RegisterController@index');
$router->get(App . '/dang-xuat', 'Auth\\LogoutController@index');
$router->get(App . '/quan-ly/nguoi-dung', 'Auth\\Admin@user');
$router->get(App . '/quan-ly/cong-thuc', 'Auth\\Admin@recipe');
$router->get(App . '/quan-ly/thanh-phan', 'Auth\\Admin@ingredient');


/* Action đăng ký */
$router->post(App . '/dang-nhap', 'Auth\\LoginController@login');

<?php

/*
    Note:
    Rule đặt tên trong Controllers Router một cách mượt mà :
    + Tên Class và tên file phải luôn giống nhau và phải có Controller ở cuối.
    + Đặt tên file theo PascalCase
    + Ví dụ: tên file là HomeController.php thì class là HomeController 
    + Đặc biệt là trong Controllers là phải đưa vào class và  phải có method cụ thể mặc định là index() để sử dụng Router
    biết được khi gọi đến class nào thì sẽ gọi đến method nào.
*/


namespace App\Controllers;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
class BaseController
{
    const VIEW_FOLDER_NAME = 'Views';
    const MODEl_FOLDER_NAME = 'Models';

    // Create Method for get classes in Views
    protected function loadView($viewPath, array $data = [])
    {
        foreach ($data as $Recipe) {
            echo "ID: {$Recipe['id']}, Name: {$Recipe['name']}, Direction: {$Recipe['directions']}<br>";
        }

        $viewFile = realpath(__DIR__ . '/../' . self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $viewPath) . '.php');

        if ($viewFile !== false) {
            require $viewFile;
        } else {
            echo "View file not found: $viewFile";
            require ROOT_PATH . '/Views/404.php';
        }
    }
    // Create Method for get classes in Models
}

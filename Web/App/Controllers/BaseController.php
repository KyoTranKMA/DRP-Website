<?php namespace App\Controllers;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
class BaseController {
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
        } 
    } 
    // Create Method for get classes in Models
}

?>
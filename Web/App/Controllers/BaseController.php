<?php
namespace App\Controllers;
use App\Core\Logger;
use App\Core\Router;

require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');


class BaseController {
    const VIEW_FOLDER_NAME = 'Views';
    const MODEl_FOLDER_NAME = 'Models';    

    // Create Method for get classes in Views
    protected static function loadView($viewPath, $data = []) {
        try {
            extract($data);
            $viewFile = VIEWS_PATH . str_replace('.', '/', $viewPath) . '.php';
            if (file_exists($viewFile) && is_readable($viewFile)) {
                require $viewFile;
            } else {
                throw new \Exception("View file not found: $viewFile");
            } 
        } catch (\Exception $e) {
            handleException($e);
            echo \App\Views\ViewRender::errorViewRender('404');
        } 
    }
}

?>
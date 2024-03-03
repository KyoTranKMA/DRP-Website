<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$controllerDirectory = __DIR__; // Thư mục chứa các file controller
$routes = generateRoutes($controllerDirectory);

function generateRoutes($controllerDirectory) {
    $routes = [];

    $controllerFiles = scandir($controllerDirectory);
    foreach ($controllerFiles as $file) {
        if ($file !== '.' && $file !== '..' && is_file($controllerDirectory . '/' . $file)) {
            $controllerName = pathinfo($file, PATHINFO_FILENAME);
            // Xây dựng route từ tên controller, ví dụ: UserController.php sẽ có route /user
            $route = '/' . strtolower(str_replace('Controller', '', $controllerName));
            $routes[$route] = $file;
        }
    }

    return $routes;
}

function routerToController($uri, $routes) {
    $urlParts = explode('/', $uri);
    $controllerName = $urlParts[1];
    $action = $urlParts[2];

    $controllerFile = $routes['/' . $controllerName];
    require __DIR__ . '/' . $controllerFile;

    $controllerClass = 'App\\Controllers\\' . pathinfo($controllerFile, PATHINFO_FILENAME);
    $controller = new $controllerClass();

    // Gọi phương thức action tương ứng
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        abort(404);
    }
}

function abort($code = 404) {
    http_response_code($code);
    require __DIR__ . "/../Errors/{$code}.php";
}

routerToController($uri, $routes);
?>

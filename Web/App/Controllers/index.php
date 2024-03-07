<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Page</title>
</head>
<body>
    <h1>Dish Page</h1>
    <ul>
        <li><a href="index.php?action=index">Index</a></li>
        <li><a href="index.php?action=show&id=1">Show Dish 1</a></li>
        <li><a href="index.php?action=update&id=1">Update Dish 1</a></li>
        <li><a href="index.php?action=delete&id=1">Delete Dish 1</a></li>
    </ul>

    <?php 
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'index':
            case 'show':
            case 'update':
            case 'delete':
                $controllerDirectory = __DIR__ . "/../Controllers";
                require_once $controllerDirectory . '/RecipeController.php';
                $controllerClass = 'App\Controllers\RecipeController';
                $controller = new $controllerClass();
                if (method_exists($controller, $action)) {
                    $controller->$action();
                } else {
                    echo "Action not found!";
                }
                break;
            default:
                echo "Invalid action!";
                break;
        }
    }
    ?>
</body>
</html>

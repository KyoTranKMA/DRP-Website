<?php 
namespace App\Controllers;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $userControllers = new UserController();

    switch ($action) {
        case 'login':
            $userControllers->login();
            break;

        // case 'register':
        //     echo 'Perform register action';
        //     break;

        // default:
        //     echo 'Unknown action';
        //     break;
    }
}

?>
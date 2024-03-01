<?php namespace App\Controllers;

    //use App\Controllers;

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
<?php namespace App\Views\auth;

    require($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');

    if (isset($_SESSION) && isset($_SESSION['logged_in'])){
        echo "<h1>Welcome back!</h1>";
    } else {
        header("Location: login.php");
    }
?>
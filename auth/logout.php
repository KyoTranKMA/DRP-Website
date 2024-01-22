<?php

    require_once(__DIR__ . "/../includes/init.php");
    Logout::handleLogout();
    // Redirect to the homepage
    header("Location: ../pages/homepage.php");
    exit;

?>

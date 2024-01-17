<?php

    require_once(__DIR__ . "/../../../../classes/logout.php");
    LogoutHandler::handleLogout();
    // Redirect to the homepage
    header("Location: ../../homepage/homepage.php");
    exit;

?>

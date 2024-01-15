
<?php
    require_once(__DIR__ . "/../log-in/init-session.php");

    unset($_SESSION["id"]);
    unset($_SESSION["name"]);

    unset($_SESSION["counter"]);
    // Destroy only invalod when delete next request 
    session_destroy();
    // Delete cookie of user
    setcookie("user", "", time() - 3600, "/");
    header("Location: ../../homepage/homepage.php");

?>

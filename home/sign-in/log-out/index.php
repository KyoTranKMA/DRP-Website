
<?php
    require_once(__DIR__ . "/../log-in/init-session.php");

    unset($_SESSION["id"]);
    unset($_SESSION["name"]);

    unset($_SESSION["counter"]);
    //Session_destroy();
    header("Location: ../../homepage/homepage.php");

?>

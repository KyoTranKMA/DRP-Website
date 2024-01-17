<?php

require_once(__DIR__ . "/../classes/database.php");
require_once(__DIR__ . "/../utils/config.php");


$db = new DataBase(
    DB_HOST,
    DB_NAME,
    DB_USER,
    DB_PASSWORD,
    DB_PORT,
    DB_SOCKET
);

$connection = $db->getConnection();

return $connection;

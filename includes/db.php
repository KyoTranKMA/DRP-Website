<?php

require_once(__DIR__ . "/init.php");

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
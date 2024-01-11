<?php

require_once(__DIR__ . "/../classes/database.php");
require_once(__DIR__ . "/../utils/config.php");

$host = DB_HOST;
$dbname = DB_NAME;
$username = DB_USER;
$password = DB_PASSWORD;
$port = DB_PORT;
$socket = DB_SOCKET;


$db = new DataBase($host, $dbname, $username, $password, $port, $socket);

$connection = $db->getConnection();

return $connection;

?>
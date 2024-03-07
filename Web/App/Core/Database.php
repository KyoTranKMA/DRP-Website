<?php
namespace App\Core;

require_once('init.php');
require_once(__DIR__ . '/../../Config/db_config.php');

class Database
{
    // Delcare Propertys of Database
    private static $DB_CONNECTION;
    private static $DB_HOST;
    private static $DB_NAME;
    private static $DB_USER;
    private static $DB_PASSWORD;
    private static $DB_PORT;
    private static $DB_SOCKET;


    // Constructor Method
    public function __construct(
            $DB_CONNECTION = DB_CONNECTION,
            $DB_HOST = DB_HOST,
            $DB_NAME = DB_NAME,
            $DB_USER = DB_USER,
            $DB_PASSWORD = DB_PASSWORD,
            $DB_PORT = DB_PORT,
            $DB_SOCKET = DB_SOCKET
        ){
        self::$DB_CONNECTION = $DB_CONNECTION;
        self::$DB_HOST = $DB_HOST;
        self::$DB_NAME = $DB_NAME;
        self::$DB_USER = $DB_USER;  
        self::$DB_PASSWORD = $DB_PASSWORD;
        self::$DB_PORT = $DB_PORT;
        self::$DB_SOCKET = $DB_SOCKET;
    }
    

    // Connection Method
    static public function getConnection()
    {
        // Create Data Source Name
        $dsn = self::$DB_CONNECTION . ":host=" . self::$DB_HOST . ";dbname=" . self::$DB_NAME . ";port=" . self::$DB_PORT . ";unix_socket=" . self::$DB_SOCKET . ";charset=utf8";
        // Using Method Connect \PDO
        try {
            $connection = new \PDO(
                $dsn,
                self::$DB_USER,
                self::$DB_PASSWORD
            );
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
            return $connection;
        } catch (\PDOException $e) {
            echo $e->getMessage() . " <br> ";
            return false;
        }
    }
}
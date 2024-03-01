<?php
namespace App\Controllers;
use App\Models\DatabaseModel;
class DatabaseController extends BaseController
{
    private static $instance = null;
    private $connection;

    private function __construct() {
        require_once(__DIR__ . "../config/db_config.php");
        $instance = new DatabaseModel(
            DB_HOST,
            DB_NAME,
            DB_USER,
            DB_PASSWORD,
            DB_PORT,
            DB_SOCKET
        );
        
    }

    // Static Method to get only 1 connection to db 
    public static function getInstance() {
        if (!self::$instance) {
            require_once(__DIR__ . "../config/db_config.php");
            self::$instance = new DataBaseModel(DB_HOST,
            DB_NAME,
            DB_USER,
            DB_PASSWORD,
            DB_PORT,
            DB_SOCKET);
        }
        return self::$instance;
    }

    public function getConnection() {
        $this->connection = $this->instance->getConnection();
        return $this->connection;
    }
}



?>
<?php namespace App\Models;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class DatabaseModel
{
    // Delcare Propertys of Database
    protected $DB_HOST;
    protected $DB_NAME;
    protected $DB_USER;
    protected $DB_PASSWORD;
    protected $DB_PORT;
    protected $DB_SOCKET;


    // Constructor Method
    public function __construct($host, $name, $user, $password, $port, $socket)
    {
        $this->DB_HOST = $host;
        $this->DB_NAME = $name;
        $this->DB_USER = $user;
        $this->DB_PASSWORD = $password;
        $this->DB_PORT = $port;
        $this->DB_SOCKET = $socket;
    }

    // Connection Method
    public function getConnection()
    {
        // Create Data Source Name
        $dsn = "mysql:host=$this->DB_HOST;dbname=$this->DB_NAME;port=$this->DB_PORT;unix_socket=$this->DB_SOCKET;charset=utf8";

        // Using Method Connect \PDO
        try {
            $connection = new \PDO(
                $dsn,
                $this->DB_USER,
                $this->DB_PASSWORD
            );
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // echo "Connect to MySQL sever successfull <br>";
            return $connection;
        } catch (\PDOException $e) {
            echo "Error in connection: "  . $e->getMessage() . " <br> ";
            exit;
        }
    }
}

?>
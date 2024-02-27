
<?php
class DataBase
{
    // Delcare Propertys of DataBase
    protected $DB_CONNECTION;
    protected $DB_HOST;
    protected $DB_NAME;
    protected $DB_USER;
    protected $DB_PASSWORD;
    protected $DB_PORT;
    protected $DB_SOCKET;


    // Constructor Method
    public function __construct()
    {
        require_once(__DIR__ . '/../../Config/db_config.php');
        $this->DB_CONNECTION = DB_CONNECTION;
        $this->DB_HOST = DB_HOST;
        $this->DB_NAME = DB_NAME;
        $this->DB_USER = DB_USER;
        $this->DB_PASSWORD = DB_PASSWORD;
        $this->DB_PORT = DB_PORT;
        $this->DB_SOCKET = DB_SOCKET;
    }

    // Connection Method
    public function getConnection()
    {
        // Create Data Source Name
        $dsn = "$this->DB_CONNECTION:host=$this->DB_HOST;dbname=$this->DB_NAME;port=$this->DB_PORT;unix_socket=$this->DB_SOCKET;charset=utf8";

        // Using Method Connect PDO
        try {
            $connection = new PDO(
                $dsn,
                $this->DB_USER,
                $this->DB_PASSWORD
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connect to MySQL sever successfull <br>";
            return $connection;
        } catch (PDOException $e) {
            echo "Error in connection"  . $e->getMessage() . " <br> ";
            exit;
        }
    }
}

?>
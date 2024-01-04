<?
    class DataBase{
        // Delcare Propertys of DB
        protected $DB_HOST;
        protected $DB_NAME;
        protected $DB_USER;
        protected $DB_PASSWORD;


        // Constructor Method
        public function __construct($HOST, $NAME, $USER, $PASSWORD)
        {
            $this->DB_HOST = $HOST;
            $this->DB_NAME = $NAME;
            $this->DB_USER = $USER;
            $this->DB_PASSWORD = $PASSWORD;
        }
        // Connection Method
        public function getConnnection()
        {
            // Create Data Source Name && Method Connect by DBO
            $dsn = "mysql:host=($this->DB_HOST);dbname=($this->DB_NAME);charset =utf8";
            try
            {
                $connection = new PDO($dsn, $this.DB_USER, $this.DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connection;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
                exit;
            }
        }



    }

?>



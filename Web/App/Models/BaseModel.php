<?php

class BaseModel extends DataBase
{
    protected $connection;
    public function __construct()
    {
        parent::__construct();
        $this->connection = $this->getConnection();
    }
    // Create Method Connection to DB for Models
    protected function getConnect()
    {
        return parent::getConnection();
    }
    // Create Method get all common for Models
    public function all($table)
    {
        $sql = "select * from $table";
        return $this->query($sql);
    }

    private function query($sql)
    {
        try {
            // Prepare the statement
            $stmt = $this->getConnect()->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "BaseModel");
            if ($stmt->execute()) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }

    }
}





?>
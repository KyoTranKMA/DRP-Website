<?php

class BaseModel extends DataBase
{
    protected $connection;
    public function __construct()
    {
        parent::__construct();
    }
    // Method Connection to DB for Models
    protected function getConnect()
    {
        return parent::getConnection();
    }
    private function query($sql, $className)
    {
        try {
            // Prepare the statement
            $stmt = $this->getConnect()->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
            if ($stmt->execute()) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    // Method common for get all for Models
    public function all($className, $table, $select, $limit = 5)
    {
        $select = implode(',',$select); // Convert from arr to string
        $sql = "select {$select} from {$table} limit {$limit} ";
        $query = $this->query($sql, $className);
        return $query;
    }
    // Method common for get by id for Models
    public function find($className, $table, $id)
    {
        $sql = "select * from {$table} where id=:$id limit 1";
        $query = $this->query($sql, $className);
        return $query;
    }
    // Method common for get by id for Models
    public function add($className, $table, $fields ,$value)
    {
        $fields = implode(',',$fields);
        $value = implode(',',$value);
        $sql = "insert into {$table}($fields) values ($value)";
        $query = $this->query($sql, $className);
        return $query;
    }

}





?>
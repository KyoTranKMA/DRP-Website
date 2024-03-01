<?php 
namespace App\Models;
use App\Core\DataBase, PDO, PDOException;

class BaseModel extends Database
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
    // Method common for get all for Models
    public function showById($className, $table, $id)
    {
        $sql = "select * from {$table} where id:=$id ";
        $query = $this->query($sql, $className);
        return $query;
    }
    
    // Method common for find by id for Models
    public function find($className, $table, $id)
    {
        $sql = "select * from {$table} where id=:$id limit 1";
        $query = $this->query($sql, $className);
        return $query;
    }
    // Method common for check data for Models
    public function check($className, $table, $data)
    {
        $sql = "select * from {$table} where $data=:$data limit 1";
        $stmt = $this->getConnect()->prepare($sql);
        $stmt->bindValue(':$data', $data, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "$className");
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) {
            return true;
        }
        return false;
    }
    // Method common for add data for Models
    public function create($className, $table, $data = [])
    {
        $colums = implode(',', array_keys($data));

        $values = array_map(function($value){
            return "'" . $value . "'";
        }, array_values($data));
        $values = implode(',', $values);

        $sql = "insert into {$table}($colums) values ($values)";
        $query = $this->query($sql, $className);
        return $query;
    }


    public function update($className, $table, $id, $data)
    {
        try {
            $dataSets = [];
            foreach($data as $key => $val)
            {
                array_push($dataSets, "{$key} = '. $val .'");
            }
            $dataString = implode(',', $dataSets);

            $sql = "update $table set {$dataString} where id = :id";

            // Prepare the statement
            $stmt = $this->getConnect()->prepare($sql);

            // Bind parameters
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            // Execute the statement
            if ($stmt->execute()) {
                echo "Đã cập nhật thành công <br>";
                return true;
            } else {
                echo "Cập nhật thất bại <br>";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($className, $table, $id)
    {
        try {
            $sql = "delete from {$table} where id=:id";
            // Prepare the statement
            $stmt = $this->getConnect()->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "$className");
            if ($stmt->execute()) {
                echo "Đã xoá " . $id .  " thành công <br>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}





?>
<?php 
namespace App\Models;
use App\Core\Database;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class BaseModel  {
    private $DB_CONNECTION;
    protected $connection; 
    public function __construct()
    {
        $this->DB_CONNECTION = new Database();
        $this->connection = $this->DB_CONNECTION->getConnection();
        if ($this->connection === false) {
            echo "Error: Unable to establish database connection. <br>";
            exit;
        }
    }

    private function query($sql)
    {
        try {
            // Make sure the connection is established
            if ($this->connection !== null) {
                $stmt = $this->connection->prepare($sql);
                $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
                if ($stmt->execute()) {
                    $data = $stmt->fetchAll();
                    return $data;
                }
            } else {
                throw new \PDOException("Error: Unable to establish database connection. <br>");
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    // Method common for get all for Models
    public function all($table, $selectRow, $limit = 5)
    {
        $selectRow = implode(',',$selectRow); // Convert from arr to string
        $sql = "select {$selectRow} from {$table} limit {$limit} ";
        $query = $this->query($sql);
        return $query;
    }
    // Method common for get all for Models
    public function showById($table, $id)
    {
        $sql = "select * from {$table} where id=:$id ";
        $query = $this->query($sql);
        return $query;
    }
    
    // Method common for find by id for Models
    public function find($table, $id)
    {
        $sql = "select * from {$table} where id=:$id limit 1";
        $query = $this->query($sql);
        return $query;
    }
    // Method common for check data for Models
    public function check($table, $field, $data)
    {
        $sql = "select * from {$table} where {$field}=:data limit 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':data', $data, \PDO::PARAM_STR);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\\Models\\UserModel');
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) {
            return true;
        }
        return false;
    }
    // Method common for add data for Models
    public function create($table, $data = [])
    {
        $colums = implode(',', array_keys($data));

        $values = array_map(function($value){
            return "'" . $value . "'";
        }, array_values($data));
        $values = implode(',', $values);

        $sql = "insert into {$table}($colums) values ($values)";
        $query = $this->query($sql);
        return $query;
    }


    public function update($table, $id, $data)
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
            $stmt = $this->connection->prepare($sql);

            // Bind parameters
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            // Execute the statement
            if ($stmt->execute()) {
                echo "Đã cập nhật thành công <br>";
                return true;
            } else {
                echo "Cập nhật thất bại <br>";
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($table, $id)
    {
        try {
            $sql = "delete from {$table} where id=:id";
            // Prepare the statement
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
            if ($stmt->execute()) {
                echo "Đã xoá " . $id .  " thành công <br>";
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
?>
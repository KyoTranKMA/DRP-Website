<?php 
namespace App\Models;
use App\Core\Database;
// use autoload from composer
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');


class BaseModel  {
    private $DB_CONNECTION;

    public function __construct() {
        $this->DB_CONNECTION = new Database();
    }
    protected function getConnect() {return $this->DB_CONNECTION->getConnection();;}

    static protected function query($sql, $fetchMode = \PDO::FETCH_ASSOC, $params = []) {
        $dbconnect = new static();
        try {
            // Make sure the connection is established
            if ($dbconnect->getConnect() !== null) {
                $stmt = $dbconnect->getConnect()->prepare($sql);
                if (!empty($params)) {
                    foreach ($params as $key => $value) {
                        $stmt->bindValue($key, $value);
                    }
                }
                if ($stmt->execute()) {
                    $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
                    return $stmt->fetchAll($fetchMode);
                }
            } else {
                throw new \PDOException("Error: Unable to establish database connection. <br>");
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    
    // Method common for get all for Models
    static public function all($table, $selectRow, $limit = 5, $fetchMode = \PDO::FETCH_ASSOC)
    {
        $selectRow = implode(',', $selectRow); // Convert from array to string
        $sql = "select {$selectRow} from {$table} limit  {$limit}";
        $query = self::query($sql, $fetchMode);
        return $query;
    }
    
    // Method common for get all for Models
    static public function showById($table, $id)
    {
        $sql = "select * from {$table} where id=:$id ";
        $query = self::query($sql, \PDO::FETCH_ASSOC, [':id' => $id]);
        return $query;
    }
    
    static public function getByName($table, $name)
    {
        $sql = "select * from {$table} where name=:name in natural language mode ";
        $query = self::query($sql, \PDO::FETCH_ASSOC, [':name' => $name]);
        return $query;
    }

    // Method common for find by id for Models
    static public function find($table, $id)
    {
        $sql = "select * from {$table} where id=:$id limit 1";
        $query = self::query($sql, \PDO::FETCH_ASSOC, [':id' => $id]);
        return $query;
    }
    // Method common for check data for Models
    static public function check($table, $field, $data)
    {
        $sql = "select * from {$table} where {$field}=:data limit 1";
        $result = self::query($sql, \PDO::FETCH_ASSOC, [':data' => $data]);
        return !empty($result);
    }
    // Method common for add data for Models
    static public function create($table, $data = [])
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $sql = "insert into {$table} ({$columns}) values ({$values})";
        return self::query($sql, \PDO::FETCH_ASSOC, array_values($data));

    }

    static public function update($table, $id, $data)
    {
        $dataSets = [];
        foreach($data as $key => $val)
        {
            $dataSets[] = "{$key} = ?";
        }
        $dataString = implode(',', $dataSets);

        $sql = "update {$table} set {$dataString} where id= ?";
        $dataValues = array_values($data);
        $dataValues[] = $id;

        return self::query($sql, \PDO::FETCH_ASSOC, $dataValues);
    }

    static public function delete($table, $id)
    {
        $sql = "delete from {$table} where id = ?";
        return self::query($sql, \PDO::FETCH_ASSOC, [$id]);
    }


}  
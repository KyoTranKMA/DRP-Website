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
    protected function getConnect() {return $this->DB_CONNECTION->getConnection();}

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
                throw new \PDOException("Error: Unable to establish database connection - " .  __METHOD__);
            }
        } catch (\PDOException $e) {
            handlePDOException($e);
            return false;
        } catch (\Exception $e) {
            handleException($e);
            return false;
        } catch (\Throwable $e) {
            handleError($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
            return false;
        } 
    }

    static public function check($table, $field, $data) {
        $sql = "select * from {$table} where {$field}=:data limit 1";
        $result = self::query($sql, \PDO::FETCH_ASSOC, [':data' => $data]);
        return !empty($result);
    }

}  
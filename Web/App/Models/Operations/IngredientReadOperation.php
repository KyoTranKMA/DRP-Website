<?php
namespace App\Operations;
use App\Models\IngredientModel;

class IngredientReadOperation extends DatabaseRelatedOperation implements I_ReadOperation {
  public function __construct() {
    parent::__construct();
  }
  static public function getSingleObjectById($id) {

    /** 
     * @var \PDO $conn
     *  
     * Make sure the connection to the database is established
     */

    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return;
    }


    /**
     * @var int $id 
     * 
     * Prepare the SQL statement and bind the parameter
     */

    $sql = "select * from ingredients where id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

    /**
     * Execute the statement and return the value
     */

    try {
      if ($stmt->execute()) {
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return IngredientModel::createObjectByRawArray($row);
      } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    return;
  }
  static public function getAllObjects() {

    /** 
     * @var \PDO $conn
     *  
     * Make sure the connection to the database is established
     */ 
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return;
    }

    /**
     * Prepare the SQL statement and execute it
     */

    $sql = "select * from ingredients";
    $stmt = $conn->prepare($sql);

    /**
     * Execute the statement and return the value
     */

    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createObjectByRawArray($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
      } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    return;
  }

  public static function getObjectWithOffset(int $offset = 0, int $limit = null) {
      
      /** 
      * @var \PDO $conn
      *  
      * Make sure the connection to the database is established
      */

      if ($limit === null) {
        $limit = $offset + 5;
      }

      try {
        $model = new static;
        $conn = $model->DB_CONNECTION;
        if ($conn == false)
          throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      } catch (\PDOException $PDOException) {
        handlePDOException($PDOException);
        echo \App\Views\ViewRender::errorViewRender('500');
        return;
      }
  
      /**
      * @var int $offset
      * @var int $limit
      *
      * Prepare the SQL statement and execute it
      */
  
      $sql = "select * from ingredients limit :limit offset :offset";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
      $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
  
      /**
      * Execute the statement and return the value
      */
  
      try {
        if ($stmt->execute()) {
          $ingredients = [];
          while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $ingredient = IngredientModel::createObjectByRawArray($row);
            $ingredients[] = $ingredient;
          }
          return $ingredients;
        } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
      } catch (\Exception $exception) {
        handleException($exception);
      } catch (\Throwable $throwable) {
        handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
      }
      echo \App\Views\ViewRender::errorViewRender('500');
      return;

  }

  static public function getAllObjectsByFieldAndValue(string $columnName, $value) {

    /** 
     * @var \PDO $conn
     *  
     * Make sure the connection to the database is established
     */
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false)
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    } catch (\PDOException $PDOException)  {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return;
    }

    /**
     * @var string $columnName
     * @var string $value
     *
     * Prepare the SQL statement and execute it
     */
    $sql = "select * from ingredients where {$columnName} like '%{$value}%'";
    $stmt = $conn->prepare($sql);
    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createObjectByRawArray($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
      } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    return;
  }
  static public function getObjectWithOffsetByFielAndValue(string $name, $value, int $offset = 0, int $limit = null) {

    /** 
     * @var \PDO $conn
     *  
     * Make sure the connection to the database is established
     */

    if ($limit === null) {
      $limit = $offset + 5;
    }
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false)
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return;
    }


    /**
     * @var string $name
     * @var string $value
     * @var int $offset
     * @var int $limit
     *
     * Prepare the SQL statement and execute it
     */

    $sql = "select * from ingredients where {$name} = {$value} limit :limit offset :offset";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);


    /**
     * Execute the statement and return the value
     */

    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createObjectByRawArray($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
      } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    return;
  }

  static public function getIdAndNameAllObject(){
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false)
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
      return;
    }

    $sql = "select id, name from ingredients";
    $stmt = $conn->prepare($sql);
    try {
      if ($stmt->execute()) {
        $pairs = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $pairs[] = [
            'id' => $row['id'],
            'name' => $row['name']
          ];
        }
        return $pairs;
      } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    return;
  }
}

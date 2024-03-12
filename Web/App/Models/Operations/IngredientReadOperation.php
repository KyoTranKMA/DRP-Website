<?php
namespace App\Operations;
use App\Core\Logger;
use App\Models\IngredientModel;

class IngredientReadOperation extends DatabaseRelatedOperation implements ReadOperation {
  public function __construct() {
    parent::__construct();
  }
  static public function getSingleObjectById($id) {
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
    } catch (\PDOException $PDOException) {
      Logger::logError(DB_RELATED_LOG, $PDOException->getMessage());
      echo \App\Views\ViewRender::errorViewRender('500');
      die;
    }
    $sql = "select * from ingredients where id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    try {
      if ($stmt->execute()) {
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return IngredientModel::createIngredientFromRow($row);
      } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      Logger::logError(EXCEPTION_LOG, $exception->getMessage());
    } catch (\Throwable $throwable) {
      Logger::logError(ERROR_LOG, $throwable->getMessage());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    die;
  }
  static public function getAllObjects() {
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
    } catch (\PDOException $PDOException) {
      Logger::logError(DB_RELATED_LOG, $PDOException->getMessage());
      echo \App\Views\ViewRender::errorViewRender('500');
      die;
    }
    $sql = "select * from ingredients";
    $stmt = $conn->prepare($sql);
    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createIngredientFromRow($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
      } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      Logger::logError(EXCEPTION_LOG, $exception->getMessage());
    } catch (\Throwable $throwable) {
      Logger::logError(ERROR_LOG, $throwable->getMessage());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    die;
  }
  static public function getAllObjectsByFieldAndValue(string $columnName, $value) {
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false)
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    } catch (\PDOException $PDOException) {
      Logger::logError(DB_RELATED_LOG, $PDOException->getMessage());
      echo \App\Views\ViewRender::errorViewRender('500');
      die;
    }
    $sql = "select * from ingredients where {$columnName} like '%{$value}%'";
    $stmt = $conn->prepare($sql);
    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createIngredientFromRow($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
      } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      Logger::logError(EXCEPTION_LOG, $exception->getMessage());
    } catch (\Throwable $throwable) {
      Logger::logError(ERROR_LOG, $throwable->getMessage());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    die;
  }
  static public function getObjectWithOffsetByFielAndValue(string $name, $value, int $offset = 0, int $limit = null) {
    if ($limit === null) {
      $limit = $offset + 5;
    }
    try {
      $model = new static;
      $conn = $model->DB_CONNECTION;
      if ($conn == false)
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    } catch (\PDOException $PDOException) {
      Logger::logError(DB_RELATED_LOG, $PDOException->getMessage());
      echo \App\Views\ViewRender::errorViewRender('500');
      die;
    }

    $sql = "select * from ingredients where {$name} = {$value} limit :offset, :limit";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
    try {
      if ($stmt->execute()) {
        $ingredients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = IngredientModel::createIngredientFromRow($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
      } else throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    } catch (\Exception $exception) {
      Logger::logError(EXCEPTION_LOG, $exception->getMessage());
    } catch (\Throwable $throwable) {
      Logger::logError(ERROR_LOG, $throwable->getMessage());
    }
    echo \App\Views\ViewRender::errorViewRender('500');
    die;
  }

}

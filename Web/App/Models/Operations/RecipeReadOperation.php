<?
namespace App\Operations;

class RecipeReadOperation extends DatabaseRelatedOperation implements I_ReadOperation {
  static public function getAllObjects() {
    try{
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      $sql = "select * from recipes";
      return self::query($sql, $conn, \PDO::FETCH_ASSOC);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
  }
  static public function getAllObjectsByFieldAndValue(string $fieldName, $value) {
    try {
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      $sql = "select * from recipes where {$fieldName} = :value";
      return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['value' => $value]);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
  }
  static public function getSingleObjectById(int $id)
  {
    try{ 
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      $sql = "select * from recipes where id = :id";
      return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['id' => $id]);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
  }

  static public function getObjectWithOffsetByFielAndValue(string $fieldName, $value, int $offset = 0, int $limit = 5) {
    try {
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      $sql = "select * from recipes where {$fieldName} = :value limit :offset, :limit";
      return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['value' => $value, 'offset' => $offset, 'limit' => $limit]);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return false;
  }

  static public function getIngredientDetailsByRecipeId(int $recipeId) {
    try {
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      $sql = "select * from recipe_ingredients where recipe_id = :recipe_id";
      return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['recipe_id' => $recipeId]);
    }
    catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
    return false;
  }
}
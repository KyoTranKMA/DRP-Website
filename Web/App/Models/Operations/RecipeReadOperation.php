<?
namespace App\Operations;

use App\Models\RecipeModel;

class RecipeReadOperation extends DatabaseRelatedOperation implements I_ReadOperation {

  public function __construct() {
    parent::__construct();
  }

  static public function getAllObjects() {
    try{
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      $sql = "select * from recipes";
      $data = self::query($sql, $conn, \PDO::FETCH_ASSOC);
      $recipes = [];
      foreach($data as $recipe){
        $recipes[] = RecipeModel::createObjectByRawArray($recipe);
      }
      return $recipes;
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
  }

  static public function getObjectWithOffset(int $offset = 0, int $limit = null) {

    if($limit == null) {
      $limit = $offset + 5;
    }


    /** 
     * @var \PDO $conn
     *  
     * Make sure the connection to the database is established
     */

    try {
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      $sql = "select * from recipes limit {$limit} offset {$offset}";
      
      $data = self::query($sql, $conn, \PDO::FETCH_ASSOC);
      $recipes = [];
      foreach($data as $recipe){
        $recipes[] = RecipeModel::createObjectByRawArray($recipe);
      }
      return $recipes;
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
      $sql = "select * from recipes where {$fieldName} = {$value}";
      $data = self::query($sql, $conn, \PDO::FETCH_ASSOC);
      $recipes = [];
      foreach($data as $recipe){
        $recipes[] = RecipeModel::createObjectByRawArray($recipe);
      }
      return $recipes;
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
      $recipe = RecipeModel::createObjectByRawArray(self::query($sql, $conn, \PDO::FETCH_ASSOC, ['id' => $id]));
      return $recipe;
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      echo \App\Views\ViewRender::errorViewRender('500');
    } catch (\Exception $exception) {
      handleException($exception);
    } catch (\Throwable $throwable) {
      handleError($throwable->getCode(), $throwable->getMessage(), $throwable->getFile(), $throwable->getLine());
    }
  }

  static public function getObjectWithOffsetByFielAndValue(string $fieldName, $value, int $offset = 0, int $limit = null) {

    if ($limit == null) {
      $limit = $offset + 5;
    }

    /** 
     * @var \PDO $conn
     *  
     * Make sure the connection to the database is established
     */

    try {
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
      $sql = "select * from recipes where {$fieldName} = {$value} limit {$limit} offset {$offset}";
      $data = self::query($sql, $conn, \PDO::FETCH_ASSOC);
      $recipes = [];
      foreach($data as $recipe){
        $recipes[] = RecipeModel::createObjectByRawArray($recipe);
      }
      return $recipes;
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

      $data = self::query($sql, $conn, \PDO::FETCH_ASSOC, ['recipe_id' => $recipeId]);
      $recipes = [];
      foreach($data as $recipe){
        $recipes[] = RecipeModel::createObjectByRawArray($recipe);
      }
      return $recipes;
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

  static public function getPaging(int $limit, int $offset) {
    try {
        $model = new static();
        $conn = $model->DB_CONNECTION;
        if ($conn == null) {
            throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
        }

        
        $stmt = $conn->prepare("select * from recipes limit :limit offset :offset");
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        // Fetch Data
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        // Response data JSON
        return json_encode($data);
    } catch (\PDOException $PDOException) {
        handlePDOException($PDOException);
        return json_encode(["error" => "Database error: " . $PDOException->getMessage()]);
    } catch (\Exception $exception) {
        handleException($exception);
        return json_encode(["error" => "Internal server error: " . $exception->getMessage()]);
    }
}


}
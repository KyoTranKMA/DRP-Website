<?
namespace App\Operations;

use App\Models\RecipeModel;

class RecipeReadOperation extends DatabaseRelatedOperation implements I_ReadOperation {

  public function __construct() {
    parent::__construct();
  }

  /**
   * Retrieves all recipe recipes from the database.
   *
   * @return array|null An array of RecipeModel objects representing the recipes retrieved from the database.
   *
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is any other exception thrown during the execution of the method.
   */
  static public function getAllObjects() : ?array{
    try{
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == false) {
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
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

  /**
   * Retrieve an array of recipe objects with an offset and limit.
   *
   * @param int $offset The offset value for retrieving recipes.
   * @param int|null $limit The limit value for retrieving recipes. If not provided, default limit is set to offset + 5.
   * @return array|null An array of recipe objects or null if an error occurs.
   */
  static public function getObjectWithOffset(int $offset = 0, int $limit = null) : ?array {

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
      if ($conn == false) {
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
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


  /**
   * Retrieves all objects from the database table 'recipes' that match the given field and value.
   *
   * @param string $fieldName The name of the field to search for.
   * @param mixed $value The value to match against the field.
   * @return array|null An array of RecipeModel objects representing the matching recipes, or null if no matches found.
   */
  static public function getAllObjectsByFieldAndValue(string $fieldName, $value) :?array{
    try {
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == false) {
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
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

  
  /**
   * Retrieves a single RecipeModel object by its ID.
   *
   * @param int $id The ID of the recipe to retrieve.
   * @return RecipeModel|null The RecipeModel object if found, or null if not found.
   */
  static public function getSingleObjectById(int $id) : ?RecipeModel{
    try{ 
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == false) {
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
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


  /**
   * Retrieves an array of recipe objects from the database based on the given field name and value, with optional offset and limit.
   *
   * @param string $fieldName The name of the field to search for.
   * @param mixed $value The value to match in the specified field.
   * @param int $offset The offset for pagination (default: 0).
   * @param int|null $limit The maximum number of records to retrieve (default: null).
   * @return array|null An array of recipe objects matching the specified criteria, or null if no records found.
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is an unhandled exception.
   * @throws \Throwable If there is a throwable error.
   */
  static public function getObjectWithOffsetByFielAndValue(string $fieldName, $value, int $offset = 0, int $limit = null) :?array {

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
      if ($conn == false) {
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
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
    return null;
  }


  /**
   * Retrieves the details of ingredients for a given recipe ID.
   *
   * @param int $recipeId The ID of the recipe.
   * @return array|null An array of RecipeModel objects representing the ingredient details, or null if an error occurs.
   */
  static public function getIngredientDetailsByRecipeId(int $recipeId) :?array {
    try {
      $model = new static();
      $conn = $model->DB_CONNECTION;
      if ($conn == false) {
        throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
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
    return null;
  }


  /**
   * Retrieves a paginated list of recipes from the database.
   *
   * @param int $limit The maximum number of recipes to retrieve.
   * @param int $offset The number of recipes to skip before starting to retrieve.
   * @return string The JSON-encoded response containing the retrieved recipes.
   * @throws \PDOException If there is an error connecting to the database.
   * @throws \Exception If there is an internal server error.
   */
  static public function getPaging(int $limit, int $offset) {
    try {
        $model = new static();
        $conn = $model->DB_CONNECTION;
        if ($conn == false) {
            throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
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
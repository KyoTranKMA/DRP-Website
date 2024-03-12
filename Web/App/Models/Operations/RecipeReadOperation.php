<?
namespace App\Operations;

class RecipeReadOperation extends DatabaseRelatedOperation implements ReadOperation {
  static public function getAllObjects() {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "select * from recipes";
    return self::query($sql, $conn, \PDO::FETCH_ASSOC);
  }

  static public function getAllObjectsByFieldAndValue(string $fieldName, $value) {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "select * from recipes where {$fieldName} = :value";
    return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['value' => $value]);
  }
  static public function getSingleObjectById(int $id)
  {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "select * from recipes where id = :id";
    return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['id' => $id]);
  }

  static public function getObjectWithOffsetByFielAndValue(string $fieldName, $value, int $offset = 0, int $limit = 5) {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "select * from recipes where {$fieldName} = :value limit :offset, :limit";
    return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['value' => $value, 'offset' => $offset, 'limit' => $limit]);
  }

  static public function getIngredientDetailsByRecipeId(int $recipeId) {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "select * from recipe_ingredients where recipe_id = :recipe_id";
    return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['recipe_id' => $recipeId]);
  }
}
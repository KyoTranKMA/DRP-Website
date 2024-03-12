<?
namespace App\Operations;

class RecipeDeleteOperation extends DatabaseRelatedOperation implements I_DeleteOperation {
  static public function deleteById($id) {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    
    $sql = "delete from ingredient_recipe where recipe_id = :id; delete from recipes where id = :id";
    return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['id' => $id]);
  }

  static public function deleteByFieldAndValue($fieldName, $value) {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "delete from ingredient_recipe where recipe_id = (select id from recipes where {$fieldName} = :value); delete from recipes where {$fieldName} = :value";
    return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['value' => $value]);
  }

  static public function deleteByIngredientComponent($ingredientName){
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "delete from ingredient_recipe where ingredient_id = (select id from ingredients where name = :ingredientName); 
        delete from recipes where id in (select recipe_id from ingredient_recipe 
        where ingredient_id = (select id from ingredients where name = :ingredientName))";
    return self::query($sql, $conn, \PDO::FETCH_ASSOC, ['ingredientName' => $ingredientName]);
  }
}
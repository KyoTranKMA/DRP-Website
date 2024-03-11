<?
namespace App\Models;
use App\Core\Logger;
class IngredientCreateOperation extends CreateAndOperation {
  static public function notify($message) {
    echo $message;
  }
  static public function validateData($data = null) {
    if ($data === null) { $data = $_POST; }
    $validCategories = array('EMMP', 'FAO', 'FRU', 'GNBK', 'HRBS', 'MSF', 'OTHR', 'PRP', 'VEGI');
    $validMeasurements = array('tsp', 'cup', 'tbsp', 'g', 'lb', 'can', 'oz', 'unit');
    if (!in_array($data['category'], $validCategories)) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    if (!in_array($data['measurement_description'], $validMeasurements)) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    if (empty($data['name'] || !preg_match('/^[a-zA-Z0-9]+$/', $data['name']))) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
  }
  static public function saveToDatabase($data = null) {
    $conn = new static();
    if ($data === null) { $data = $_POST; }
    if ($conn === null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "insert into ingredients (name, category, calcium, calories, carbohydrate, 
    cholesterol, fiber, iron, fat, monounsaturated_fat, polyunsaturated_fat, 
    saturated_fat, potassium, protein, sodium, sugar, vitamin_a, vitamin_c) 
    values (:name, :category, :calcium, :calories, :carbohydrate, :cholesterol, 
    :fiber, :iron, :fat, :monounsaturated_fat, :polyunsaturated_fat, :saturated_fat, 
    :potassium, :protein, :sodium, :sugar, :vitamin_a, :vitamin_c)";
    // ...

    parent::query($sql, $conn, \PDO::FETCH_ASSOC, [ // Call the query method on the parent class
      'name' => $data['name'],
      'category' => $data['category'],
      'calcium' => $data['calcium'] ? $data['calcium'] : 0,
      'calories' => $data['calories'] ? $data['calories'] : 0,
      'carbohydrate' => $data['carbohydrate'] ? $data['carbohydrate'] : 0,
      'cholesterol' => $data['cholesterol'] ? $data['cholesterol'] : 0,
      'fiber' => $data['fiber'] ? $data['fiber'] : 0,
      'iron' => $data['iron'] ? $data['iron'] : 0,
      'fat' => $data['fat'] ? $data['fat'] : 0,
      'monounsaturated_fat' => $data['monounsaturated_fat'] ? $data['monounsaturated_fat'] : 0,
      'polyunsaturated_fat' => $data['polyunsaturated_fat'] ? $data['polyunsaturated_fat'] : 0,
      'saturated_fat' => $data['saturated_fat'] ? $data['saturated_fat'] : 0,
      'potassium' => $data['potassium'] ? $data['potassium'] : 0,
      'protein' => $data['protein'] ? $data['protein'] : 0,
      'sodium' => $data['sodium'] ? $data['sodium'] : 0,
      'sugar' => $data['sugar'] ? $data['sugar'] : 0,
      'vitamin_a' => $data['vitamin_a'] ? $data['vitamin_a'] : 0,
      'vitamin_c' => $data['vitamin_c'] ? $data['vitamin_c'] : 0
    ]);
  }
  static public function execute(){
    try {
      self::validateData();
    }
    catch(\InvalidArgumentException $InvalidArgumentException) {
      Logger::logError(ERROR_LOG, $InvalidArgumentException->getMessage());
      self::notify($InvalidArgumentException->getMessage());
      return false;
    }
    try {
      self::saveToDatabase();
    } catch(\PDOException $PDOException) {
      Logger::logError(DB_RELATED_LOG, $PDOException->getMessage());
      self::notify($PDOException->getMessage());
      return false;
    }
    return true;
  }
}
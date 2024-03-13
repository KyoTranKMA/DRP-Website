<?
namespace App\Operations;

class  IngredientUpdateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation {
  static public function notify($message) {
    echo "<script>alert('$message')</script>";
  }
  static public function validateData($data) {
    if($data == null) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    $validCategories = array('EMMP', 'FAO', 'FRU', 'GNBK', 'HRBS', 'MSF', 'OTHR', 'PRP', 'VEGI');
    $validMeasurements = array('tsp', 'cup', 'tbsp', 'g', 'lb', 'can', 'oz', 'unit');
    if (!in_array($data['category'], $validCategories)) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    if (!in_array($data['measurement_description'], $validMeasurements)) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    if (empty($data['name'] || !preg_match('/^[a-zA-Z0-9]+$/', $data['name']))) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
  }

  static public function saveToDatabase($data) {
    $conn = new static();
    if ($data === null) { $data = $_POST; }
    if ($conn === null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "update ingredients set name = :name, category = :category, calcium = :calcium, 
            calories = :calories, carbohydrate = :carbohydrate, cholesterol = :cholesterol, 
            fiber = :fiber, iron = :iron, fat = :fat, monounsaturated_fat = :monounsaturated_fat, 
            polyunsaturated_fat = :polyunsaturated_fat, saturated_fat = :saturated_fat, 
            potassium = :potassium, protein = :protein, sodium = :sodium, sugar = :sugar, 
            vitamin_a = :vitamin_a, vitamin_c = :vitamin_c where id = :id";

    self::query($sql, $conn, \PDO::FETCH_ASSOC, [ 
      'name' => $data['name'],
      'category' => $data['category'],
      'calcium' => $data['calcium'] ?? 0,
      'calories' => $data['calories'] ?? 0,
      'carbohydrate' => $data['carbohydrate'] ?? 0,
      'cholesterol' => $data['cholesterol'] ?? 0,
      'fiber' => $data['fiber'] ?? 0,
      'iron' => $data['iron'] ?? 0,
      'fat' => $data['fat'] ?? 0,
      'monounsaturated_fat' => $data['monounsaturated_fat'] ?? 0,
      'polyunsaturated_fat' => $data['polyunsaturated_fat'] ?? 0,
      'saturated_fat' => $data['saturated_fat'] ?? 0,
      'potassium' => $data['potassium'] ?? 0,
      'protein' => $data['protein'] ?? 0,
      'sodium' => $data['sodium'] ?? 0,
      'sugar' => $data['sugar'] ?? 0,
      'vitamin_a' => $data['vitamin_a'] ?? 0,
      'vitamin_c' => $data['vitamin_c'] ?? 0
    ]);
  }
  static public function execute($data)
  {
    try {
      self::validateData($data);
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      handleError($InvalidArgumentException->getCode(), $InvalidArgumentException->getMessage(), 
        $InvalidArgumentException->getFile(), $InvalidArgumentException->getLine());
      self::notify("Update ingredient failed casued by: " . $InvalidArgumentException->getMessage());
      return false;
    }
    try {
      self::saveToDatabase($data);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      self::notify("Update ingredient failed casued by: " . $PDOException->getMessage());
      return false;
    }
    self::notify("Ingredient created successfully!");
    return true;
  }
}
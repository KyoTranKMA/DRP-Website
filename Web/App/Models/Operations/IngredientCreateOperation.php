<?

namespace App\Operations;

class IngredientCreateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation {
  public function __construct() {
    parent::__construct();
  }
  static public function notify($message) {
    echo "<script>alert('$message')</script>";
  }
  static public function validateData($data)
  {
    if($data == null) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    $validCategories = array('EMMP', 'FAO', 'FRU', 'GNBK', 'HRBS', 'MSF', 'OTHR', 'PRP', 'VEGI');
    $validMeasurements = array('tsp', 'cup', 'tbsp', 'g', 'lb', 'can', 'oz', 'unit');
    if (empty($data['name']) || !preg_match('/^[a-zA-Z0-9]+$/', $data['name']) ||
        empty($data['category']) || !in_array($data['category'], $validCategories) ||
        empty($data['measurement_description']) || !in_array($data['measurement_description'], $validMeasurements) 
    )
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
  }
  static public function saveToDatabase($data)
  {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "insert into ingredients (name, category, calcium, calories, carbohydrate, 
    cholesterol, fiber, iron, fat, monounsaturated_fat, polyunsaturated_fat, 
    saturated_fat, potassium, protein, sodium, sugar, vitamin_a, vitamin_c) 
    values (:name, :category, :calcium, :calories, :carbohydrate, :cholesterol, 
    :fiber, :iron, :fat, :monounsaturated_fat, :polyunsaturated_fat, :saturated_fat, 
    :potassium, :protein, :sodium, :sugar, :vitamin_a, :vitamin_c)";

    self::query($sql, $conn, \PDO::FETCH_ASSOC, [ 
      'name' => $data['name'],
      'category' => $data['category'],
      'measurement_description' => $data['measurement_description'], 
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
      handleException($InvalidArgumentException);
      self::notify("Add ingredient failed casued by: " . $InvalidArgumentException->getMessage());
      return false;
    }
    try {
      self::saveToDatabase($data);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      self::notify("Add ingredient failed casued by: " . $PDOException->getMessage());
      return false;
    }
    self::notify("Ingredient created successfully!");
    return true;
  }
}

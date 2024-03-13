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
    /**
     * Validate the data with specific rules
     * name: required, only letters and numbers
     * category: required, must be one of the valid categories
     * measurement_description: required, must be one of the valid measurements
     * calcium, calories, carbohydrate, cholesterol, fiber, iron, fat, monounsaturated_fat, polyunsaturated_fat,
     * saturated_fat, potassium, protein, sodium, sugar, vitamin_a, vitamin_c: optional, must be a number
     */
  
    if($data == null) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    $validCategories = array('EMMP', 'FAO', 'FRU', 'GNBK', 'HRBS', 'MSF', 'OTHR', 'PRP', 'VEGI');
    $validMeasurements = array('tsp', 'cup', 'tbsp', 'g', 'lb', 'can', 'oz', 'unit');

    $requiredFields = ['name', 'category', 'measurement_description'];
    $numericFields = ['calcium', 'calories', 'carbohydrate', 'cholesterol', 'fiber', 'iron', 'fat', 
      'monounsaturated_fat', 'polyunsaturated_fat', 'saturated_fat', 'potassium', 'protein', 'sodium', 'sugar', 'vitamin_a', 'vitamin_c'];

    foreach ($requiredFields as $field) {
      if (empty($data[$field])) {
        throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
      }
    }

    foreach ($numericFields as $field) {
      if (!empty($data[$field]) && !is_numeric($data[$field])) {
        throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
      }
    }

    if (!preg_match('/^[a-zA-Z0-9]+$/', $data['name'])) {
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    }

    if (!in_array($data['category'], $validCategories)) {
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    }

    if (!in_array($data['measurement_description'], $validMeasurements)) {
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    }
  }
  static public function saveToDatabase($data) {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }


    $sql = "INSERT INTO ingredients (name, category, calcium, calories, carbohydrate, 
    cholesterol, fiber, iron, fat, monounsaturated_fat, polyunsaturated_fat, 
    saturated_fat, potassium, protein, sodium, sugar, vitamin_a, vitamin_c) 
    VALUES (:name, :category, :calcium, :calories, :carbohydrate, :cholesterol, 
    :fiber, :iron, :fat, :monounsaturated_fat, :polyunsaturated_fat, :saturated_fat, 
    :potassium, :protein, :sodium, :sugar, :vitamin_a, :vitamin_c)";

    /** 
     * Execute the query with the given data
     */
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
    /**
     * Validate the data before saving to the database
     */
    try {
      self::validateData($data);
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      handleException($InvalidArgumentException);
      self::notify("Add ingredient failed casued by: " . $InvalidArgumentException->getMessage());
      return false;
    }

    /**
     * Saving datab to database process
     */
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

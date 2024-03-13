<? 
namespace App\Operations;

class RecipeCreateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation {
  public function __construct() {
    parent::__construct();
  }
  static public function notify($message) {
    echo $message;
  }
  static public function validateData($data) {
    if($data == null) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    $cate1 = ['Breakfast','Lunch','Dinner'];
    $cate2 = ['Appetizer','Main Dish','Side Dish','Dessert'];
    $cate3 = ['Baked','Salad and Salad Dressing','Sauce and Condiment','Snack','Beverage','Soup','Other'];
    if (!preg_match('/^[a-zA-Z0-9\s.,]+$/', $data['name'])) {
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    }
    if (empty($data['name']) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $data['name']) ||
        empty($data['description']) || 
        empty($data['image_url']) || 
        empty($data['preparation_time']) || 
        empty($data['cooking_time']) || 
        empty($data['direction']) || 
        empty($data['meal_type_1']) ||
        empty($data['meal_type_2']) ||
        empty($data['meal_type_3']) ||
        (!in_array($data['meal_type_1'], $cate1)) ||
        (!in_array($data['meal_type_2'], $cate2)) ||
        (!in_array($data['meal_type_3'], $cate3))) {
      throw new \Exception(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    }
  }
  static public function saveToDatabase($data = null) {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    $sql = "insert into recipes (name, description, image_url, preparation_time, 
              cooking_time, direction, meal_type_1, meal_type_2, meal_type_3) 
            values (:name, :description, :image_url, :preparation_time, 
              :cooking_time, :direction, :meal_type_1, :meal_type_2, :meal_type_3)";
    $params = [
      'name' => $data['name'],
      'description' => $data['description'],
      'image_url' => $data['image_url'],
      'preparation_time' => $data['preparation_time'],
      'cooking_time' => $data['cooking_time'],
      'direction' => $data['direction'],
      'meal_type_1' => $data['meal_type_1'],
      'meal_type_2' => $data['meal_type_2'],
      'meal_type_3' => $data['meal_type_3']
    ];
    self::query($sql, $conn, \PDO::FETCH_ASSOC, $params);
  }
  static public function execute($data){
    try {
      self::validateData($data);
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      handleException($InvalidArgumentException);
      self::notify("Add recipe failed casued by: " . $InvalidArgumentException->getMessage());
      return false;
    }
    try {
      self::saveToDatabase($data);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      self::notify("Add recipe failed casued by: " . $PDOException->getMessage());
      return false;
    }
    self::notify("Recipe created successfully!");
    return true;
  }
}
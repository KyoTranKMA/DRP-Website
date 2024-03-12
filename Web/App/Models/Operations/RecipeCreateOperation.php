<? 
namespace App\Operations;
use App\Core\Logger;
class RecipeCreateOperation extends DatabaseRelatedOperation implements CreateAndUpdateOperation {
  public function __construct() {
    parent::__construct();
  }
  static public function notify($message) {
    echo $message;
  }
  static public function validateData($data = null) {
    $cate1 = ['Breakfast','Lunch','Dinner'];
    $cate2 = ['Appetizer','Main Dish','Side Dish','Dessert'];
    $cate3 = ['Baked','Salad and Salad Dressing','Sauce and Condiment','Snack','Beverage','Soup','Other'];
    if (empty($data['name']) || 
        empty($data['description']) || 
        empty($data['image_url']) || 
        empty($data['preparation_time']) || 
        empty($data['cooking_time']) || 
        empty($data['direction']) || 
        empty($data['meal_type_3']) ||
        (!empty($data['meal_type_1']) && !in_array($data['meal_type_1'], $cate1)) ||
        (!empty($data['meal_type_2']) && !in_array($data['meal_type_2'], $cate2)) ||
        (!empty($data['meal_type_3']) && !in_array($data['meal_type_3'], $cate3))) {
      throw new \Exception(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    }
  }
  static public function saveToDatabase($data = null) {
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
      'meal_type_1' => $data['meal_type_1'] ?? null,
      'meal_type_2' => $data['meal_type_2'] ?? null,
      'meal_type_3' => $data['meal_type_3']
    ];
    try {
      self::query($sql, \PDO::FETCH_ASSOC, $params);
    } catch (\Exception $e) {
      throw new \Exception($e->getMessage());
    }
  }
  static public function execute(){
    try {
      self::validateData();
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      Logger::logError(ERROR_LOG, $InvalidArgumentException->getMessage());
      self::notify("Add ingredient failed casued by: " . $InvalidArgumentException->getMessage());
      return false;
    }
    try {
      self::saveToDatabase();
    } catch (\PDOException $PDOException) {
      Logger::logError(DB_RELATED_LOG, $PDOException->getMessage());
      self::notify("Add ingredient failed casued by: " . $PDOException->getMessage());
      return false;
    }
    self::notify("Ingredient created successfully!");
    return true;
  }
}
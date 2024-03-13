<? 
namespace App\Operations;

class RecipeUpdateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation {
  static public function notify($message) {
    echo "<script>alert('$message')</script>";
  }
  static public function validateData($data) {
    if($data == null) 
      throw new \InvalidArgumentException(self::MSG_DATA_ERROR . __METHOD__ . '. ');
    $cate1 = ['Breakfast','Lunch','Dinner'];
    $cate2 = ['Appetizer','Main Dish','Side Dish','Dessert'];
    $cate3 = ['Baked','Salad and Salad Dressing','Sauce and Condiment','Snack','Beverage','Soup','Other'];
    if (empty($data['name']) || !preg_match('/^[a-zA-Z]+$/', $data['name']) ||
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

  static public function saveToDatabase($data) {
    $conn = new static();
    if ($conn === null) {
      throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }
    $sql = "update recipes set name = :name, description = :description, image_url = :image_url, 
            preparation_time = :preparation_time, cooking_time = :cooking_time, direction = :direction, 
            meal_type_1 = :meal_type_1, meal_type_2 = :meal_type_2, meal_type_3 = :meal_type_3 where id = :id";

    self::query($sql, $conn, \PDO::FETCH_ASSOC, [ 
      'id' => $data['id'],
      'name' => $data['name'],
      'description' => $data['description'],
      'image_url' => $data['image_url'],
      'preparation_time' => $data['preparation_time'],
      'cooking_time' => $data['cooking_time'],
      'direction' => $data['direction'],
      'meal_type_1' => $data['meal_type_1'],
      'meal_type_2' => $data['meal_type_2'],
      'meal_type_3' => $data['meal_type_3']
    ]);
  }
  static public function execute($data){
    try {
      self::validateData($data);
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      handleException($InvalidArgumentException);
      self::notify("Update recipe failed casued by: " . $InvalidArgumentException->getMessage());
      return false;
    }
    try {
      self::saveToDatabase($data);
      self::notify("Update recipe successfully! ");
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      self::notify("Update recipe failed casued by: " . $PDOException->getMessage());
      return false;
    }
  }
}
<? 
namespace App\Operations;
use App\Controllers\Dialog;

class RecipeUpdateOperation extends DatabaseRelatedOperation implements I_CreateAndUpdateOperation {

  public function __construct() {
    parent::__construct();
  }

  static public function notify(string $message) : void {
    Dialog::show($message);
  }


  /**
   * Validates the recipe data with specific rules.
   *
   * @param array $data The recipe data to be validated.
   * @return void
   * @throws \InvalidArgumentException If the data is invalid.
   * @throws \Exception If the data is missing or does not meet the validation rules.
   */
  static public function validateData(array $data) : void {
    // Validate data2
    if ($data == null) {
      throw new \InvalidArgumentException("Invalid data provided in " . __METHOD__ . ".");
    }

    $validCategories1 = ['Breakfast', 'Lunch', 'Dinner'];
    $validCategories2 = ['Appetizer', 'Main Dish', 'Side Dish', 'Dessert'];
    $validCategories3 = ['Baked', 'Salad and Salad Dressing', 'Sauce and Condiment', 'Snack', 'Beverage', 'Soup', 'Other'];

    if (
      empty($data['name']) || !preg_match('/^[a-zA-Z0-9\s.,]+$/', $data['name']) ||
      empty($data['cooking_time_min']) ||
      empty($data['preparation_time_min']) ||
      empty($data['meal_type_1']) ||
      empty($data['meal_type_2']) ||
      empty($data['meal_type_3']) ||
      empty($data['directions']) ||
      empty($data['description'])) {
      throw new \Exception("Invalid data provided in " . __METHOD__ . ".");
    }
    if(  (!in_array($data['meal_type_1'], $validCategories1)) ||
      (!in_array($data['meal_type_2'], $validCategories2)) ||
      (!in_array($data['meal_type_3'], $validCategories3))
    ) {
      throw new \Exception("Invalid data provided in " . __METHOD__ . ".");
    }
  }


  /**
   * Saves the recipe data to the database.
   *
   * @param array $data The recipe data to be saved.
   * @return void
   * @throws \PDOException If there is an error connecting to the database.
   */
  static public function saveToDatabase(array $data) : void 
  {
    $model = new static();
    $conn = $model->DB_CONNECTION;
    if ($conn == false) {
      throw new \PDOException(parent::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
    }


    $sql = "UPDATE recipes set name = :name, description = :description, mej
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


  /**
   * Executes the recipe update operation.
   *
   * This method validates the provided data, saves it to the database, and notifies the user about the result.
   *
   * @param array $data The data to update the recipe.
   * @return bool Returns true if the recipe update was successful, false otherwise.
   */
  static public function execute($data) : bool{
    try {
      self::validateData($data);
    } catch (\InvalidArgumentException $InvalidArgumentException) {
      handleException($InvalidArgumentException);
      self::notify("Update recipe failed casued by: " . htmlspecialchars($InvalidArgumentException->getMessage()));
      return false;
    }
    try {
      self::saveToDatabase($data);
    } catch (\PDOException $PDOException) {
      handlePDOException($PDOException);
      self::notify("Update recipe failed casued by: " . htmlspecialchars($PDOException->getMessage()));
      return false;
    }
    
    self::notify("Update recipe successfully! ");
    return true;
  }
}
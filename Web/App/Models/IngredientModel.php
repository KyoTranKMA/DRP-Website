<?

namespace App\Models;
use App\Core\Logger;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class IngredientModel extends BaseModel {
  const TABLE = 'ingredients';
  private $id;
  private $name;
  private $category;
  private $nutritionComponents;

  const MSG_EXECUTE_PDO_LOG = "Error in executing prepare statement - ";
  const MSG_INPUT_DATA_EMPTY = "Error: input data cannot be empty - ";
  const MSG_CONNECT_PDO_EXCEPTION = "Error: Unable to establish database connection - ";


  public function __construct($id = null, $name = null, $category = null, $nutritionComponents = null) {
    parent::__construct();
    $this->id = $id ?? 0;
    $this->name = $name ?? '';
    $this->category = $category ?? '';
    $this->nutritionComponents = $nutritionComponents ?? [
      'calcium' => null,
      'calories' => null,
      'carbohydrate' => null,
      'cholesterol' => null,
      'fiber' => null,
      'iron' => null,
      'fat' => null,
      'monounsaturated_fat' => null,
      'polyunsaturated_fat' => null,
      'saturated_fat' => null,
      'potassium' => null,
      'protein' => null,
      'sodium' => null,
      'sugar' => null,
      'vitamin_a' => null,
      'vitamin_c' => null
    ];
  }
  public function getId() { return $this->id; }
  public function getName() { return $this->name; }
  public function getCategory() { return $this->category; }
  public function getNutritionComponents() { return $this->nutritionComponents; }
  public function setId($id) { $this->id = $id; }
  public function setName($name) { $this->name = $name; }
  public function setCategory($category) { $this->category = $category; }
  public function setNutritionComponents($nutritionComponents) {
    $this->nutritionComponents = $nutritionComponents;
  }
  static private function createIngredientFromRow($row) {
    $ingredient = new IngredientModel();
    $ingredient->setID($row['id']);
    $ingredient->setName($row['name']);
    $ingredient->setCategory($row['category']);
    $nutritionComponents = [
      'calcium' => $row['calcium'],
      'calories' => $row['calories'],
      'carbohydrate' => $row['carbohydrate'],
      'cholesterol' => $row['cholesterol'],
      'fiber' => $row['fiber'],
      'iron' => $row['iron'],
      'fat' => $row['fat'],
      'monounsaturated_fat' => $row['monounsaturated_fat'],
      'polyunsaturated_fat' => $row['polyunsaturated_fat'],
      'saturated_fat' => $row['saturated_fat'],
      'potassium' => $row['potassium'],
      'protein' => $row['protein'],
      'sodium' => $row['sodium'],
      'sugar' => $row['sugar'],
      'vitamin_a' => $row['vitamin_a'],
      'vitamin_c' => $row['vitamin_c'],
    ];
    $ingredient->setNutritionComponents($nutritionComponents);
    return $ingredient;
  }
  static public function getAll() {
    $dbcon = new static();
    try {
      // Make sure the connection is established
      if ($dbcon->getConnect() === null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
    } catch(\PDOException $PDOException) {
      Logger::logError(DB_RELATED_LOG, $PDOException->getMessage());
      echo(\App\Views\ViewRender::errorViewRender('500'));
      die;
    } 

    $table = self::TABLE;
    $sql = "select * from {$table}";
    try {
      $stmt = $dbcon->getConnect()->prepare($sql);
      if ($stmt->execute()) {
        $ingridients = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
          $ingrident = self::createIngredientFromRow($row);
          $ingridients[] = $ingrident;
        }
        return $ingridients;
      } else {
        throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
      }
    } catch (\Exception $exception) {
      Logger::logError(EXCEPTION_LOG, $exception->getMessage());      
    }catch (\Throwable $throwable) {
      Logger::logError(ERROR_LOG, $throwable->getMessage());
    }
    return NULL;
  }
  static public function getByName($name, $table = self::TABLE, $limit = 10)  {
    $functionName = __FUNCTION__;
    $dbconnect = new static();
    $sql = "select * from {$table} where match(name) against(:name in natural language mode) limit :limit";
    try {
      if ($dbconnect->getConnect() === null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . $functionName);
      }
    } catch(\PDOException $PDOException) {
      Logger::logError(DB_RELATED_LOG, $PDOException->getMessage());
      echo(\App\Views\ViewRender::errorViewRender('500'));
      die;
    }
    try {
      $query = $dbconnect->getConnect()->prepare($sql);
      if (empty($name)) {
        throw new \Exception(self::MSG_INPUT_DATA_EMPTY . $functionName);
      }
    } catch(\Exception $exception) {
      Logger::logError(EXCEPTION_LOG, $exception->getMessage());
      die($exception->getMessage());
    }
    try{
      $query->bindValue(':name', $name, \PDO::PARAM_STR);
      $query->bindValue(':limit', $limit, \PDO::PARAM_INT);

      if ($query->execute()) {
        $ingredients = [];
        while($row = $query->fetch(\PDO::FETCH_ASSOC)) {
          $ingredient = self::createIngredientFromRow($row);
          $ingredients[] = $ingredient;
        }
        return $ingredients;
      } else {
        throw new \Exception(self::MSG_EXECUTE_PDO_LOG . $functionName);
      }
    } catch (\Throwable $throwable) {
      Logger::logError(ERROR_LOG, $throwable->getMessage());
    }
    return NULL;
  }

  static public function create($table = self::TABLE, $data = null){
    $dbconnect = new static();
    if ($data === null) { $data = $_POST; }
    try  { 
      if ($dbconnect->getConnect() === null) {
        throw new \PDOException(self::MSG_CONNECT_PDO_EXCEPTION . __METHOD__ . '. ');
      }
    } catch(\PDOException $PDOException) {
      Logger::logError(DB_RELATED_LOG, $PDOException->getMessage());
      return $PDOException->getMessage();
    }
    try {
      if (empty($data)) {
        throw new \Exception(self::MSG_INPUT_DATA_EMPTY . __METHOD__ . '. ');
      }
    } catch(\Exception $exception) {
      Logger::logError(EXCEPTION_LOG, $exception->getMessage());
      die($exception->getMessage());
    }
    try {
      $sql = "insert into {$table} (name, category, calcium, calories, carbohydrate, 
          cholesterol, fiber, iron, fat, monounsaturated_fat, polyunsaturated_fat, 
          saturated_fat, potassium, protein, sodium, sugar, vitamin_a, vitamin_c) 
          values (:name, :category, :calcium, :calories, :carbohydrate, :cholesterol, 
          :fiber, :iron, :fat, :monounsaturated_fat, :polyunsaturated_fat, :saturated_fat, 
          :potassium, :protein, :sodium, :sugar, :vitamin_a, :vitamin_c)";
      if (self::query($sql, \PDO::FETCH_ASSOC, [
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
      ]) !== null) {
        return true;
      } else {
        throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
      }
    } catch (\Throwable $throwable) {
      Logger::logError(ERROR_LOG, $throwable->getMessage());
    }
    return false;
  }
}
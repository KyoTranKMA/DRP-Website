<? 
namespace App\Models;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class IngredientModel extends BaseModel {
  private $id;
  private $name;
  private $category; 
  private $nutritionComponents; 

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
        'vitamin_c' => null,
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

  private function query($sql) {
    try {
      // Make sure the connection is established
      if ($this->getConnect() !== null) {
        $stmt = $this->getConnect()->prepare($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
        if ($stmt->execute()) {
          $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
          return $data;
        }
      } else {
        throw new \PDOException("Error: Unable to establish database connection. <br>");
      }
    } catch (\PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }

  public function all($table, $selectRow, $limit = 5) {
    $selectRow = implode(',',$selectRow); // Convert from arr to string
    $sql = "select {$selectRow} from {$table} limit {$limit} ";
    $query = $this->query($sql);
    return $query;
  }

  

}
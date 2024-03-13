<?

namespace App\Models;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class IngredientModel extends BaseModel {
  private $id;
  private $name;
  private $category;
  private $measurementDescription;
  private $nutritionComponents;

  const MSG_EXECUTE_PDO_LOG = "Error in executing prepare statement - ";
  const MSG_INPUT_DATA_EMPTY = "Error: input data cannot be empty - ";
  const MSG_CONNECT_PDO_EXCEPTION = "Error: Unable to establish database connection - ";


  public function __construct($id = null, $name = null, $category = null, $measurementDescription = null, $nutritionComponents = null) {
    parent::__construct();
    $this->id = $id ?? 0;
    $this->name = $name ?? '';
    $this->category = $category ?? '';
    $this->measurementDescription = $measurementDescription ?? '';
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
  public function getMeasurementDescription() { return $this->measurementDescription; }
  public function getNutritionComponents() { return $this->nutritionComponents; }
  public function setId($id) { $this->id = $id; }
  public function setName($name) { $this->name = $name; }
  public function setCategory($category) { $this->category = $category; }
  public function setMeasurementDescription($measurementDescription) { 
    $this->measurementDescription = $measurementDescription; 
  }
  public function setNutritionComponents($nutritionComponents) {
    $this->nutritionComponents = $nutritionComponents;
  }
  static public function createIngredientFromRow($row) {
    $ingredient = new IngredientModel();
    $ingredient->setID($row['id']);
    $ingredient->setName($row['name']);
    $ingredient->setCategory($row['category']);
    $ingredient->setMeasurementDescription($row['measurement_description']);
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
}
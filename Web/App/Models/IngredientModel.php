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
  static public function createObjectByRawArray($data) {
    $ingredient = new self();
    $ingredient->setID($data['id']);
    $ingredient->setName($data['name']);
    $ingredient->setCategory($data['category']);
    $ingredient->setMeasurementDescription($data['measurement_description']);
    $nutritionComponents = [
      'calcium' => $data['calcium'],
      'calories' => $data['calories'],
      'carbohydrate' => $data['carbohydrate'],
      'cholesterol' => $data['cholesterol'],
      'fiber' => $data['fiber'],
      'iron' => $data['iron'],
      'fat' => $data['fat'],
      'monounsaturated_fat' => $data['monounsaturated_fat'],
      'polyunsaturated_fat' => $data['polyunsaturated_fat'],
      'saturated_fat' => $data['saturated_fat'],
      'potassium' => $data['potassium'],
      'protein' => $data['protein'],
      'sodium' => $data['sodium'],
      'sugar' => $data['sugar'],
      'vitamin_a' => $data['vitamin_a'],
      'vitamin_c' => $data['vitamin_c'],
    ];
    $ingredient->setNutritionComponents($nutritionComponents);
    return $ingredient;
  }
}
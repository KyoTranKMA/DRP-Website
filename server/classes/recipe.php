<?php 

/* 
  Nhữn thành phần cần cho một công thức 
    id ,
    name, 
    có thể thuộc một hay nhiều category (Breakfast,lunch, Dinner, 
    Appetizer, Salad, Main-course, Side-dish, baked-goods, Dessert, 
    Snack, Soup, Holiday, Vegetarian, etc),
    đối tượng đặc biệt hướng đến (nếu có, ví du: người bệnh, trẻ nhỏ, người cao tuổi, etc)
    nutritionContents,
    Instructions,
    ratings
*/

  class Recipe {
    private $id;
    private $name;
    private $category;
    private $isActive;
    private $forWho;
    public $ingredientComponents;
    public $nutritionContent;
    
    public function __construct($name, $category, $ingredientComponents, $isActive = 1, $forWho = NULL) {
      try {
        $this->name = $name;
        $this->category = $category;
        $this->ingredientComponents = $ingredientComponents;
        $this->isActive = $isActive;
        $this->forWho = $forWho;
        if (!$this->validate()){
          throw new InvalidArgumentException('Error in construct new recipe: name, category, ingredient components and instruction can not be null');
        }
      }
      catch(InvalidArgumentException $exception){
        echo "Error(s) occour in construct new recipe: " . $exception->getMessage();
        return NULL;
      }
    }


    private function validate(){
      return (isset($this->name) && isset($this->category)
              && isset($this->ingredientComponents));
    }


    public function addRecipe($connection){
      try {
        $sqlStatement = "insert into recipe (name, category, isActive, forWho, ingredientComponents) 
                        values (:name, :category, :isActive, :forWho, :ingredientComponents)";
        $stmtPrepared = $connection->prepare($sqlStatement); 
        $stmtPrepared->bindValue(":name", $this->name, PDO::PARAM_STR);
        $stmtPrepared->bindValue(":category", $this->category, PDO::PARAM_STR);
        $stmtPrepared->bindValue(":isActive", $this->isActive, PDO::PARAM_INT);
        $stmtPrepared->bindValue(":forWho", $this->forWho, PDO::PARAM_STR);
        $stmtPrepared->bindValue(":ingredientComponents", $this->ingredientComponents, PDO::PARAM_STR);
        if($stmtPrepared->execute()){
          echo "Add ingredient successfully! ";
          return TRUE;
        }
        throw new PDOException("Error(s) occour in adding n2ew recipe stage! ");
      }
      catch(PDOException $exception){
        echo $exception->getMessage();
        return false;
      }
    }


    public function getAll($connection){
      try{
        $sqlStatement = "select id, name, category, forWho, ingredientComponets 
                        from recipes where isActive = 1 order by id asc";
        $stmtPrepared = $connection->prepare($sqlStatement);
        $stmtPrepared->setFetchMode(PDO::FETCH_CLASS, 'Recipe');
        if(!$stmtPrepared->execute()){
          throw new PDOException('Error(s) occour in exceuting get sql command stage! ');
        }
        $recipes = $stmtPrepared->fetchAll(PDO::FETCH_ASSOC);
        return $recipes;
      }
      catch(PDOException $exception){
        echo $exception->getMessage();
        return null;
      }
    }

    public function getByCategory($connToDB, $category){
      try {
        $sqlStatement = "select id, name, category, forWho, ingredientComponets 
                         from recipes where isActive = 1 and id=:id order by id asc";
        $prepareStatement = $connToDB->prepare($sqlStatement);
        $prepareStatement->bindValue(':category', $category, PDO::PARAM_INT);
        $prepareStatement->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
        if(!$prepareStatement->execute($prepareStatement)){
          throw new PDOException('Error(s) occour in executing get sql command stage! ');
        } 
        $ingredient = $prepareStatement->fetchAll(PDO::FETCH_ASSOC);
        return $ingredient;
      }
      catch(PDOException $exception){
        echo $exception->getMessage();
        return null;
      }
    }

    public static function getById($connectToDB, $id){
      try {
        $sqlStatement = "select id, name, category, forWho, ingredientComponets 
                         from recipes where isActive = 1 and id=:id order by id asc";
        $prepareStatement = $connectToDB->prepare($sqlStatement);
        $prepareStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $prepareStatement->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
        if(!$prepareStatement->execute($prepareStatement)){
          throw new PDOException('Error(s) occour in executing get sql command stage! ');
        } 
        $ingredient = $prepareStatement->fetch();
        return $ingredient;
      }
      catch(PDOException $exception){
        echo $exception->getMessage();
        return null;
      }
    }

    public function update($connToDB){
      try {
        $sqlStatement = "update recipes set 
                        name=:name, 
                        category=:category,
                        isActive=:isActive,
                        forWho=:forWho,
                        ingredientComponents:=ingredientComponents,
                        where id=:id";
        $prepareStatement = $connToDB->prepare($sqlStatement);
        $prepareStatement->bindValue(":name", $this->name, PDO::PARAM_STR);
        $prepareStatement->bindValue(":category", $this->category, PDO::PARAM_STR);        
        $prepareStatement->bindValue(":isActive", $this->isActive, PDO::PARAM_BOOL);    
        $prepareStatement->bindValue(":forWho=", $this->forWho, PDO::PARAM_STR);
        if(!$prepareStatement->execute($prepareStatement)){
          throw new PDOException('Error(s) occour in executing update sql command stage! ');
        }
        echo "Update successfully! ";
        return true;
      }
      catch(PDOException $exception) {
        echo $exception->getMessage();
        return false;
      }
    }

    public function deleteById($connToDB, $id){
      try { 
        $sqlStatement = "delete from recipes where id=:id";
        $prepareStatement = $connToDB->prepare($sqlStatement);
        $prepareStatement->bindValue(':id', $id, PDO::PARAM_INT);
        if(!$prepareStatement->execute($prepareStatement)){
          throw new PDOException('Error(s) occour in executing the delete prepare statement! ');
        }
        echo "Delete recipe with id: " . $id  . " successfully!";
        return true;
      }
      catch(PDOException $exception){
        echo $exception->getMessage();
        return false;
      }
    }

    public function nutritionCalculator(){
      
    } 

  }
?>
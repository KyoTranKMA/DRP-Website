<?php

/**
 * Những thức cần khi xem một loại nguyên liệu 
 * mã, tên, loại nguyên liệu, có cần chế biến theo một yêu cầu đặc biệt hay không, mô tả yêu cầu nếu có, loại định lượng cho nguyên liệu, 
 * thành phần dinh dưỡng có trong một loại định lượng và thành phần dinh dưỡng trong một 
 */
  class Ingredients {
    private $_id; 
    private $name;
    public $category;
    private $isActive;
    private $specialRequirement;
    private $measurementUnit;
    private $nutritionComponents;

    public function __construct($name, $category, $measurementUnit, $isActive = true,
                                $nutritionComponents = NULL, $specialRequirement = NULL) {
        $this->name = $name;
        $this->category = $category[0];
        $this->measurementUnit = $measurementUnit[0];
        $this->isActive = $isActive;
        $this->nutritionComponents = $nutritionComponents;
        $this->specialRequirement = $specialRequirement;
        $this->validate();
    }
     
    private function validate(){
      // check if input for attribute is validate 
      try{
        if(empty($this->name) || empty($this->measurementUnit || empty($this->category))){
          throw new InvalidArgumentException("Error in construct new ingredient. ID, name, measurement unit and category cannot be empty! ");
          return true;
        }
      }
      catch(Exception $exception) {
        echo $exception->getMessage();
        return false;
      }
    }
    
    public function addIngredient($connFromDB){
      try{
        /**
         * Prepare statement to insert a new Ingredient to the table names Ingredients
         */
        $sqlStatement = "insert into ingredients (name, category, isActive, measurementUnit, nutritionComponents, specialRequirement) 
                          values (:name, :category, :isActive, :unit, :nutritionComponents, :specReq)";
        $stmtPrepare = $connFromDB->prepare($sqlStatement);
        $stmtPrepare->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmtPrepare->bindValue(':category', $this->category, PDO::PARAM_STR);
        $stmtPrepare->bindValue(':isActive', $this->isActive, PDO::PARAM_BOOL);
        $stmtPrepare->bindValue(':unit', $this->measurementUnit, PDO::PARAM_STR);
        $stmtPrepare->bindValue(':nutritionComponents', $this->nutritionComponents, PDO::PARAM_STR);
        $stmtPrepare->bindValue(':specReq', $this->specialRequirement, PDO::PARAM_STR);
        if($stmtPrepare->execute()){
          echo "Add ingredient successfully! ";
          return true;
        }
        throw new PDOException("Error(s) occour in adding ingredient stage! ");
      }
      catch(PDOException $exception){
        echo $exception->getMessage();
        return false;
      }
    }
    
    public static function getAll($connFromDB){
      try {
        $sqlStatement = "select id, name, category, measurementUnit, specialRequirement, nutritionComponents
                        `from ingredients order by asc";
        $prepareStatement = $connFromDB->prepare($sqlStatement);
        $prepareStatement->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
        if($prepareStatement->execute()){
          $ingredients = $prepareStatement->fetchAll(PDO::FETCH_ASSOC);
          return $ingredients;
        } 
        throw new PDOException('Error(s) occour in executing get sql command stage! ');
      }
      catch(PDOException $exception){
        echo $exception->getMessage();
        return null;
      }
    }

    public static function getById($connToDB, $id){
      try {
        $sqlStatement ="select id, name, category, measurementUnit, specialRequirement, nutritionComponents
                        from ingredients where id=:id";
        $prepareStatement = $connToDB->prepare($sqlStatement);
        $prepareStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $prepareStatement->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
        if($prepareStatement->execute($prepareStatement)){
          $ingredient = $prepareStatement->fetch();
          return $ingredient;
        } 
        throw new PDOException('Error(s) occour in executing get sql command stage! ');
      }
      catch(PDOException $exception){
        echo $exception->getMessage();
        return null;
      }
    }

    public function update($connToDB){
      try {
        $sqlStatement = "update ingredients set 
                        name=:name, 
                        category=:category,
                        isActive=:isActive,
                        measurementUnit=:measurementUnit,
                        specialRequirement=:specialRequirement,
                        nutritionComponents:=nutritionComponents
                        where id=:id";
        $prepareStatement = $connToDB->prepare($sqlStatement);
        $prepareStatement->bindValue(":name", $this->name, PDO::PARAM_STR);
        $prepareStatement->bindValue(":category", $this->category, PDO::PARAM_STR);        
        $prepareStatement->bindValue(":isActive", $this->isActive, PDO::PARAM_BOOL);        
        $prepareStatement->bindValue(":measurementUnit=", $this->specialRequirement, PDO::PARAM_STR);        
        $prepareStatement->bindValue(":specialRequirement", $this->specialRequirement, PDO::PARAM_STR);
        $prepareStatement->bindValue(":nutritionComponents", $this->nutritionComponents, PDO::PARAM_STR);
        if($prepareStatement->execute($prepareStatement)){
          echo "Update successfully! ";
          return true;
        }
        throw new PDOException('Error(s) occour in executing update sql command stage! ');
      }
      catch(PDOException $exception) {
        echo $exception->getMessage();
        return false;
      }
    }
  
    public function deleteById($connToDB, $id){
      try { 
        $sqlStatement = "delete from ingredients where id=:id";
        $prepareStatement = $connToDB->prepare($sqlStatement);
        $prepareStatement->bindValue(':id', $id, PDO::PARAM_INT);
        if($prepareStatement->execute($prepareStatement)){
          echo "Xóa thành công nguyên liệu có id: " . $id  . "!";
          return true;
        }
        throw new PDOException('Error(s) occour in executing the delete prepare statement! ');
      }
      catch(PDOException $exception){
        echo $exception->getMessage();
        return false;
      }
    }
  }
?>
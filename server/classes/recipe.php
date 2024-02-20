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
    private $ingredienComponents;
    private $nutritionContents;
    private $rating;

    public function __construct($id, $name, $category, $forWho = null, $ingredientComponents, 
          $nutritionContents = null) {
      $this->id = $id;
      $this->name = $name;
      $this->category = $category;
      $this->isActive = true;
      $this->forWho = $forWho;
      $this->ingredienComponents = $ingredientComponents;
      $this->nutritionContents = $nutritionContents;
      $this->rating = 0;

      if ($this->validate()){
        throw new InvalidArgumentException('Error in construct new recipe, 
            ID (this one must be a numeric), name, category, instruction can not be null');
      }
    }

    private function validate(){
      return (isset($this->id) && isset($this->name) && isset($this->category)
          && isset($this->ingredienComponents)) && is_numeric($this->id);
    }
  }
?>
<?php 
namespace App\Models;
// use autoload from composer
require_once($_SERVER['DOCUMENT_ROOT'] . 'App/Core/init.php');

class RecipeModel extends BaseModel {
    private $id;
    private $name;
    private $description;
    private $image_url;
    private $preparation_time;
    private $cooking_time;
    private $recipe_direction;
    private $recipe_type;
    const TABLE = 'Recipes';
    public function getAll($select = ['*'], $limit = 5) { return $this->all(self::TABLE, $select, $limit);}
    public function findById($id)  { return $this->find(self::TABLE, $id); }
    public function updateById($id, $data) { return $this->update(self::TABLE, $id, $data); }
    public function deleteById($id) { return $this->delete(self::TABLE, $id); }

}

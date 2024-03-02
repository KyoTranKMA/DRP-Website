<?php namespace App\Models;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

class RecipeModel extends BaseModel
{

    const CLASSNAME = get_called_class();
    const TABLE = 'Recipes';
    public function getAll($select = ['*'], $limit = 5)
    {
        return $this->all(self::CLASSNAME ,self::TABLE, $select, $limit);
    }
    public function findById($id)
    {
        return $this->find(self::CLASSNAME , self::TABLE, $id);
    }
    public function updateById($id, $data)
    {
        return $this->update(self::CLASSNAME , self::TABLE, $id, $data);
    }
    public function deleteById($id)
    {
        return $this->delete(self::CLASSNAME , self::TABLE, $id);
    }

}

<?php

class DishModel extends BaseModel
{

    const CLASSNAME = 'DishModel';
    const TABLE = 'dishs';
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

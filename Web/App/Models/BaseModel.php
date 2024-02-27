<?php

class BaseModel extends DataBase
{
    protected $connection;
    public function __construct()
    {
        $this->connection = $this->getConnection();
    }


}





?>
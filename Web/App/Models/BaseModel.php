<?php 
namespace App\Models;
// use autoload from composer
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');


abstract class BaseModel {
    protected $isActive;

    public function __construct() {
        $this->isActive = true;
    }

    protected function setActive(bool $condition = true){
        $this->isActive = $condition;
    }
    protected function getActive(){
        return $this->isActive;
    }

    static abstract public function createObjectByRawArray($data);

}  
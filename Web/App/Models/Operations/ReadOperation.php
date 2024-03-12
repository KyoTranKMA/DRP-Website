<?
namespace App\Operations;
interface ReadOperation { 
  static function getSingleObjectById(int $id);
  static function getAllObjects(); 
  static function getAllObjectsByFieldAndValue(string $columnName, $value);
  static function getObjectWithOffsetByFielAndValue(string $name, $value, int $offset = 0, int $limit = 5);  
}

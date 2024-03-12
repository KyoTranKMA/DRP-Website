<? 
namespace App\Operations;

interface CreateAndUpdateOperation {
  static public function validateData($data);
  static public function saveToDatabase($data);
  static public function notify($message);
}

<?
namespace App\Operations;
class DatabaseRelatedOperation {
  const MSG_EXECUTE_PDO_LOG = "Error: Execute the prepare statement failed - ";
  const MSG_DATA_ERROR = "Error: input data do not match with its type or be left empty - ";
  const MSG_CONNECT_PDO_EXCEPTION = "Error: Unable to establish database connection - ";  
  
  protected $DB_CONNECTION;
  public function __construct() {
    $db = new \App\Core\Database();
    $this->DB_CONNECTION = $db->getConnection();
  }

  static protected function query($sql, $conn, $fetchMode = \PDO::FETCH_ASSOC, $params = []){
    $stmt = $conn->prepare($sql);

    /** 
     * bind the parameters if there are any 
     */

    if (!empty($params))
      foreach ($params as $key => $value)
        $stmt->bindValue($key, $value);
    /**
     * execute the statement
     */
    if ($stmt->execute()) {
      $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
      return $stmt->fetchAll($fetchMode);
    } else {
      throw new \Exception(self::MSG_EXECUTE_PDO_LOG . __METHOD__ . '. ');
    }
  }
}
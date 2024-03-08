<?
namespace App\Core;
class Logger{
  public static function logError($logFile, $message){
    if (!file_exists($logFile)) {
      $file = fopen($logFile, 'w');
      if ($file === false) {
          die('Unable to create log file.');
      }
      fclose($file);
    }
    $dateTime = date('d-m-Y s:i:H');
    $logMessage = $dateTime . ': ' . $message . PHP_EOL;
    error_log($logMessage, 3, $logFile);
  }
}
?>
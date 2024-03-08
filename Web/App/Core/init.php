<?php
use App\Core\Logger;

if (!isset($_SESSION)){
  session_start();
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Config/general_config.php");

set_error_handler('handleError');
set_exception_handler('handleException');
register_shutdown_function('handleFatalError');

function handleError(int $errno, string $errstr, string $errfile, int $errline) {
  $errorType = getErrorType($errno);
  Logger::logError(ERROR_LOG, "$errorType: [$errno] $errstr - $errfile:$errline");
}

function handleException($exception) {
  Logger::logError(EXCEPTION_LOG, "Uncaught Exception: " . $exception->getMessage());
}

function handleFatalError() {
  $lastError = error_get_last();
  if ($lastError && $lastError['type'] === E_ERROR) {
    $errorType = getErrorType($lastError['type']);
    Logger::logError(FATAL_ERROR_LOG, "$errorType: " . $lastError['message']);
  }
}

function getErrorType($errno) {
  $errorTypes = array(
    E_ERROR             => 'E_ERROR',
    E_WARNING           => 'E_WARNING',
    E_PARSE             => 'E_PARSE',
    E_NOTICE            => 'E_NOTICE',
    E_CORE_ERROR        => 'E_CORE_ERROR',
    E_CORE_WARNING      => 'E_CORE_WARNING',
    E_COMPILE_ERROR     => 'E_COMPILE_ERROR',
    E_COMPILE_WARNING   => 'E_COMPILE_WARNING',
    E_USER_ERROR        => 'E_USER_ERROR',
    E_USER_WARNING      => 'E_USER_WARNING',
    E_USER_NOTICE       => 'E_USER_NOTICE',
    E_STRICT            => 'E_STRICT',
    E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
    E_DEPRECATED        => 'E_DEPRECATED',
    E_USER_DEPRECATED   => 'E_USER_DEPRECATED'
  );
  return $errorTypes[$errno] ?? 'UNKNOWN';
}
?>
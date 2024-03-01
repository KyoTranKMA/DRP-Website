<?php 
session_start();
require_once (__DIR__ . '/../../vendor/autoload.php'); 

function exceptionHandler($exception){
  if(DEBUG){
      echo "<h2>Lỗi: " . $exception->getMessage() . "</h2>";
      echo "<p>Noi dung: " . $exception->getMessage() . "</p>";
      echo "<p>File: " . $exception->getFile() . "<br> Line: " .  $exception->getLine() . "<p>";
  } else {
      echo "<h2>Có lỗi xảy ra, vui lòng thử lại sau</h2>";
      require_once("Errors/404.php");
  }
  exit();
}

function errorHandler($level, $message, $file, $line){
  throw new ErrorException($level, $message, $file, $line);
}


set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');

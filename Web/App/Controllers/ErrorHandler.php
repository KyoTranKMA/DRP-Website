<?php

class ErrorHandler
{
  private $errorViewPath = ERRORS_PATH;
  public function handleError($errorCode) {
    switch ($errorCode) {
      case 400:
        require_once($this->errorViewPath . '400.php');
        break;
      case 403:
        require_once($this->errorViewPath . '403.php');
        break;
      case 404:
        require_once($this->errorViewPath . '404.php');
        break;
      case 500:
        require_once($this->errorViewPath . '500.php');
        break;
      default:
        require_once($this->errorViewPath . 'unknowm.php');
        break;
    }
  }
}
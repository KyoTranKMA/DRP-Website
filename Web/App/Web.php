<?php namespace App; 

use App\Controllers\HomeController;

  class Web{
    private $__controller, $__action, $__params;

    function __construct() {
      $this->__controller = 'HomeController';
      $this->__action = 'index';
      $this->__params = [];
      $this->handleURL();
    }
    public function getURL() {
      if (!empty($_SERVER['PATH_INFO'])) {
        $url = $_SERVER['PATH_INFO'];
      }else {
        $url = '/';
      }
      return $url;
    }
    public function handleURL(){
      $url = $this->getURL();
      $urlArr = array_filter(explode('/', $url));
      $urlArr = array_values($urlArr);

      // Controller handling
      if(!empty($urlArr[0])) {
        $this->__controller = ucfirst($urlArr[0]);
        if(file_exists('App/Controllers/' . ($this->__controller) . '.php')) {
          require_once('Controllers/' . ($this->__controller) . '.php');
          $this->__controller = new HomeController();
          $this->__controller->index();
        }
        else {
          $this->loadError('404');
          // trigger_error('Error 404: controller not found!');
        }
      }
    }

    public function loadError($name = '404'){
      require_once('Errors/' . $name . '.php');
    }
  }
?>
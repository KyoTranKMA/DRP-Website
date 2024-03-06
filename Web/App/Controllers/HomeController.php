<?php 
namespace App\Controllers;
// use autoload from composer
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
class HomeController extends BaseController
{
    public function index()
    {
        return $this->loadView('pages.homepage');
    }
    public function homePage()
    {
        return $this->loadView('pages.homepage');
    }


}



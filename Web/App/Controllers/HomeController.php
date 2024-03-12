<?php 
namespace App\Controllers;
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');
class HomeController extends BaseController
{
    public function index()
    {
        if ($_SESSION['level'] == 1){
            return $this->homePage();
        } else {
            return $this->admin();
        }
    }
    public static function homePage()
    {
        return parent::loadView('auth.homepage');
    }

    public static function admin()
    {
        return parent::loadView('admin.index');
    }
}



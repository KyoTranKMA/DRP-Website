<?php 
namespace App\Controllers;
require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');
class HomeController extends BaseController
{
    public function index()
    {
        return parent::loadView('pages.index');
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



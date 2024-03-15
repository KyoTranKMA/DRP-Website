<?php 
namespace App\Controllers;
use App\Operations\RecipeReadOperation;

require_once($_SERVER['DOCUMENT_ROOT'] . '/App/Core/init.php');
class HomeController extends BaseController
{
    public function index()
    {
        if ($_SESSION['level'] == 1){
            return $this->adminUser();
        } else {
            return $this->homePage();
        }
    }
    public static function homePage()
    {
        $ingredients = RecipeReadOperation::getObjectWithOffset(0,10);

        return parent::loadView('pages.homepage', $ingredients);
    }

    public static function adminUser()
    {
        header("Location: /manager/user");
    }
}



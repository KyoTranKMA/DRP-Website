<?php namespace App\Controllers;


class IngredientController extends BaseController
{
    public function index()
    {
        return $this->loadView('ingredients.index');
    }

}

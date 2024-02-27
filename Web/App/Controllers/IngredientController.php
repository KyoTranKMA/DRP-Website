<?php


class IngredientController extends BaseController
{
    public function index()
    {
        return $this->loadView('ingredients.index');
    }

}

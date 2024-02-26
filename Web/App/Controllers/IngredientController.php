<?php


class IngredientController extends BaseController
{
    public function index()
    {
        return $this->loadView('frontend.ingredients.index');
    }

}

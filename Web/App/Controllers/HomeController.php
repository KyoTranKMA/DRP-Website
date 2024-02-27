<?php

class HomeController extends BaseController
{
    public function index()
    {
        return $this->loadView('pages.index');
    }
    public function homePage()
    {
        return $this->loadView('pages.homepage');
    }


}






?>
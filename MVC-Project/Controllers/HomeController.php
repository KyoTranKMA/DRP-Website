<?php

class HomeController extends BaseController
{
    public function index()
    {
        return $this->loadView('frontend.pages.index');
    }
    public function homePage()
    {
        return $this->loadView('frontend.pages.homepage');
    }


}






?>
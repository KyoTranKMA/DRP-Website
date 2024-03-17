<?php

namespace App\Controllers;



class BmiController extends BaseController
{
    public function index()
    {
        $this->loadView('pages.bmi');
    }


}

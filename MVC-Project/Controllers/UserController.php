<?php
class UserController extends BaseController
{
    // Get Path Class User Model;
    public function __construct()
    {
        $this->loadModel('UserModel');
    } 
    public function index()
    {
        // Get Path Class User
        $userModel = new UserModel;

    }
}
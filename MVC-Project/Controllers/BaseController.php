<?php

class BaseController
{
    /*
        pathname: foldername.filename
    */
    const VIEW_FOLDER_NAME = 'Views';

    protected function loadView($viewPath)
    {
        $viewPath = self::VIEW_FOLDER_NAME . '/'.  str_replace('.', '/', $viewPath) . '.php';
        echo $viewPath;
        require("./$viewPath"); 
    } 

}

?>
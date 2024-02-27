<?php

class BaseController
{
    /*
        pathname: foldername.filename
    */
    const VIEW_FOLDER_NAME = 'Views';
    const MODEl_FOLDER_NAME = 'Models';    

    // Create Method for get classes in Views
    protected function loadView($viewPath, array $data = [])
    {
        foreach($data as $key => $value)
        {
            $$key = $value;
        }
        
        require('./' . self::VIEW_FOLDER_NAME . '/'.  str_replace('.', '/', $viewPath) . '.php'); 
    } 
    // Create Method for get classes in Models
    protected function loadModel($modelPath)
    {
        require('./' . self::MODEl_FOLDER_NAME . '/'.  str_replace('.', '/', $modelPath) . '.php');
    }

}

?>
<?php
/*
    Method autoload các class tương ứng

*/
    if (session_id() === "") session_start();
    spl_autoload_register(
        function ($className) {
            $fileName = strtolower($className) . ".php";
            $dirRoot = dirname(__DIR__);
            require $dirRoot . "/classes/($fileName)";
        }
    );
          

require dirname(__DIR__) . "/utils/config.php";

?>
<?php

// Start Session
if (session_status() == PHP_SESSION_NONE) {
    session_start();

    // Đếm số lần truy cập
    if (isset($_SESSION['counter'])) {
        $_SESSION['counter'] += 1;
    } else {
        $_SESSION['counter'] = 1;
    }
}

/*
     Method autoload các class tương ứng
*/
function classesAutoloader($className)
{
    $fileName = strtolower($className) . ".php";
    $dirRoot = dirname(__DIR__);
    $filePath = $dirRoot . "/classes/$fileName";
    // Check file path
    if (file_exists($filePath)) {
        require $filePath;
    } else {
        // Nếu không có class tương ứng trả về lỗi
        throw new Exception("Class file '$fileName' not found.");
    }
}

// Đăng ký hàm Autoload 
spl_autoload_register(
    'classesAutoloader'
);


require dirname(__DIR__) . "/utils/config.php";

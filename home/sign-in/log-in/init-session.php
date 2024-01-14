<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    
    // Đếm số lần truy cập
    if (isset($_SESSION['counter'])) {
        $_SESSION['counter'] += 1;
    } else {
        $_SESSION['counter'] = 1;
    }
}
?>

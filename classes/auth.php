<?php
    class Auth
    {
        /* 
            This Class
            ->
                Check Login
                Assign to Login
                Create Session after Login
                Delete Session, Cookie after Logout
        */
        // Check Login
        public static function isLoggedIn()
        {
            return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"];
        }

        // Require Login when access
        public static function requireLogin()
        {
            if (!static::isLoggedIn()) {
                die("Vui lòng đăng nhập");
            }
        }

        // Create Session when login
        public static function login()
        {
            session_regenerate_id(true);
            $_SESSION["logged_in"] = true;
        }

        // Delete Session and Cookies when log-out
        public static function logout()
        {
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 3600,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            session_destroy();
        }
    }




?>
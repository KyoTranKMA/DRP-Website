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
                // header("Location: ../auth/login_form.html");
            }
        }

        // Create Session when login
        public static function login($username)
        {
            $cookie_name = "user";
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + 86400 * 1, "/"); // Set cookie for 1 day
            session_regenerate_id(true); // Refresh session
            $_SESSION["logged_in"] = true;
        }

        // Delete Session and Cookies when log-out
        public static function logout()
        {
            // Delete user cookie
            setcookie("user", "", time() - 3600, "/");
            
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
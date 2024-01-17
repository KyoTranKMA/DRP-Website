

<?php



class LogoutHandler
{
    public static function logout()
    {
        require_once(__DIR__ . "/../src/home/sign-in/log-in/init-session.php");

        if (!isset($_SESSION["id"]))
        {
            echo "Bạn chưa đăng nhập vào tài khoản hệ thống";
            exit;
        }
        unset($_SESSION["id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["counter"]);

        // Destroy only when not deleting next request
        session_destroy();

        // Delete user cookie
        setcookie("user", "", time() - 3600, "/");

    }

    public static function logoutGoogle()
    {

        require_once(__DIR__ . "/../src/home/sign-in/log-in/init-session.php");

        if (!isset($_SESSION['token'])) {
            echo "Bạn chưa đăng nhập vào tài khoản Google";
            exit;
        }
        require_once(__DIR__ . "/../utils/config.php");
        $client = new Google\Client();
        $client->setAccessToken($_SESSION['token']);

        // Revoking the Google access token
        $client->revokeToken();

        // Deleting the stored session
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 3600, "/");
        }

        session_destroy();

    }

    public static function handleLogout()
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        switch ($type) {
            case 'google':
                self::logoutGoogle();
                echo '<p style="color:green"> Đăng xuất tài khoản google thành công</p>';
                break;
            case 'normal':
                self::logout();
                echo '<p style="color:green"> Đăng xuất tài khoản trên hệ thống thành công</p>';
            default:
                self::logout();
                echo "Log out thanh cong";
                break;
        }
    }
}

?>

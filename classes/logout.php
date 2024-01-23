

<?php




class Logout extends Auth
{
    public static function logout()
    {
        unset($_SESSION["logged_in"]);
        parent::logout();
    }

    public static function logoutGoogle()
    {
        require(__DIR__ . "/../config/google_oauth.php");
        $client = new Google\Client();
        $client->setAccessToken($_SESSION['token']);

        // Revoking the Google access token
        $client->revokeToken();

        // Deleting the stored session
        $_SESSION = array();

        parent::logout();

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

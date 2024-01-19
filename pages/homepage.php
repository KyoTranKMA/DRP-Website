<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
</head>

<body>
    <!--
        /*
            Sau khi đăng nhập thành công User sẽ vào trang này
            Giao diện cho người dùng ở file này
        */
    -->
    <?php
    // Get path root 
    $basePath = rtrim(str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__), '/');;
    ?>

    <div>
        <a href="<?php echo $basePath; ?>/../sign-in/log-in/index.html"> Đăng nhập hệ thống </a> &nbsp;
        <a href= "<?php echo $basePath; ?>/../sign-in/Oauth/oauth-google.php"> Đăng nhập bằng tài khoản google  </a> &nbsp;
        <a href="<?php echo $basePath; ?>/../sign-up/index.html"> Đăng ký tài khoản </a> &nbsp;
        <a href="<?php echo $basePath; ?>/../sign-in/log-out/index.php?type=normal"> Đăng xuất </a> &nbsp;
        <a href="<?php echo $basePath; ?>/../sign-in/log-out/index.php?type=google"> Đăng xuất Google </a> &nbsp;
    </div>
    <?php
        require_once(__DIR__ . "/../includes/init.php");
        try {
            $username = '';
            // Check Cookie of User 
            if ((isset($_SESSION["logged_in"])) )  {
                $username = $_COOKIE["user"];
                echo "Welcome " . $username;
                exit;
            }
            // Or Check Token of Gooogle Oauth 
            else if (isset($_SESSION['token'])) {
                require_once(__DIR__ . "/../config/google_oauth.php");

                $client->setAccessToken($_SESSION['token']);

                if ($client->isAccessTokenExpired()) {
                    header('Location: ../auth/logout.php');
                    exit;
                }
                $google_oauth = new Google\Service\Oauth2($client);
                $user_info = $google_oauth->userinfo->get();
                $username =  $user_info['givenName'];
                echo "Welcome " . $username;
            } else {
                echo "Vui lòng đăng nhập lại";
                // header("Location: ../sign-in/log-in/index.html");
            }
        } catch (Exception $e) {
            echo "" . $e->getMessage() . "";
        }

    ?>


</body>

</html>
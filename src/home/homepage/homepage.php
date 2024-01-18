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
    require("../sign-in/log-in/init-session.php");
    try {
        $username = '';
        // Set lai Session
        if ((isset($_COOKIE["user"])) )  {
            $username = $_COOKIE["user"];
            $_SESSION['counter'];
            echo "Welcome " . $username;
            exit;
        } 
        else if (isset($_SESSION['token'])) {
            require(__DIR__ . "/../../../utils/config.php");

            $client->setAccessToken($_SESSION['token']);

            if ($client->isAccessTokenExpired()) {
                header('Location: ../sign-in/log-out/index.php');
                exit;
            }
            $_SESSION['counter'];
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
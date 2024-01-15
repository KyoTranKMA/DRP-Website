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
        <a href= "<?php echo $basePath; ?>/../sign-in/log-in/index.html"> Đăng nhập hệ thống  </a> &nbsp;
        <a href="<?php echo $basePath; ?>/../sign-up/index.html"> Đăng ký tài khoản  </a> &nbsp;
        <a href= "<?php echo $basePath; ?>/../sign-in/log-out/index.php"> Đăng xuất  </a> &nbsp;
    </div>    
    <?php
        require("../sign-in/log-in/init-session.php");
        try {  
        if (isset($_COOKIE["user"]) && isset($_SESSION["id"])) {
            $username = $_COOKIE["user"];
            $_SESSION['counter'];
            echo "Welcome " . $username;
        } else {
            echo "Vui lòng đăng nhập";
            // header("Location: ../sign-in/log-in/index.html");
        }
    } catch (Exception $e) {
        echo "" . $e->getMessage() . "";
    }

    ?>


</body>

</html>
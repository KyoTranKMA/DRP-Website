<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
</head>
<body>
    <?php
    // Get path root 
    $basePath = rtrim(str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__), '/');;
    ?>

    <div>
        <a href= "<?php echo $basePath; ?>/sign-in/log-in/index.html"> Đăng nhập hệ thống  </a> &nbsp;
        <a href= "<?php echo $basePath; ?>/sign-in/Oauth/oauth-google.php"> Đăng nhập bằng tài khoản google  </a> &nbsp;
        <a href="<?php echo $basePath; ?>/sign-up/index.html"> Đăng ký tài khoản  </a> &nbsp;
        <a href="<?php echo $basePath; ?>/homepage/homepage.php"> Trang chủ </a> &nbsp;
        <a href="<?php echo $basePath; ?>/sign-in/log-out/index.php?type=normal" > Đăng xuất </a> &nbsp;
        <a href="<?php echo $basePath; ?>/sign-in/log-out/index.php?type=google"> Đăng xuất Google </a> &nbsp;

    </div>    
</body>
</html>
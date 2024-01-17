<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<body>

    <?php
    
    $errorMessage = "";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // import classes/user.php
        require_once(__DIR__  . "/../../../../index.php");
        require(__DIR__ . "/init-session.php");
        $rs = User::authenticate($conn, $username, $password);
  
        if ($rs) {
            $cookie_name = "user";
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + 86400 * 3, "/"); // Set cookie for 3 days
            $user_id = $rs->id;
            $_SESSION['id'] = $user_id;
            $_SESSION['name'] = $username;

            header("Location: ../../homepage/homepage.php"); 
            exit(); 
        } else {
            $errorMessage = "Vui lòng nhập lại tài khoản hoặc mật khẩu <br>";
        }
    }
    
    ?>

    <html>
    <span>
        <Button>
            <a href="../../homepage/homepage.php"> Trở về trang chủ</a>
        </Button>
    </span>

    <?php echo $errorMessage; // Hiển thị lỗi nếu nhập sai thông tin đăng nhập ?>

    </html>

</body>

</html>

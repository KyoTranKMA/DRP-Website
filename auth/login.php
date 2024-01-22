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
        // Get Connection and Class User
        require_once(__DIR__ .'/../index.php');
        $rs = User::authenticate($conn, $username, $password);
  
        if ($rs) {
            $cookie_name = "user";
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + 86400 * 3, "/"); // Set cookie for 3 days
            Auth::login();
            header("Location: ../pages/homepage.php"); 
            exit(); 
        } else {
            $errorMessage = "Vui lòng nhập lại tài khoản hoặc mật khẩu <br>";
        }
    }
    
    ?>

    <html>
    <span>
        <Button>
            <a href="../pages/homepage.php"> Trở về trang chủ</a>
        </Button>
    </span>

    <?php echo $errorMessage; // Hiển thị lỗi nếu nhập sai thông tin đăng nhập ?>

    </html>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<body>

    <?php

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve form data using PHP
        $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Hash the password
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        require_once(__DIR__ . "/../../index.php");
        // Check the connection
        if (!$conn) {
            echo "Connect to DB Fail <br>";
        }

        // Insert data into the 'users' tabsle
        $sql = "INSERT INTO users (username, password) VALUES ('$hoten', '$hashPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "Đã thêm tài khoản và mật khẩu";
        } else {
            echo "Error: " . $sql . "<br>" ;
        }
    }
    ?>

    <span>
        <Button>
            <a href="../homepage/index.html"> Trở về trang chủ</a>
        </Button>
    </span>

</body>

</html>

<?php

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get Connection DB and Classees defined
        require_once(__DIR__ . "/../index.php");
        // Retrieve form data using PHP
        $user = new User();
        $user->username = isset($_POST['username']) ? $_POST['username'] : '';
        $user->password = isset($_POST['password']) ? $_POST['password'] : '';
        // Check the connection
        if (!$conn) {
            echo "Connect to DB Fail <br>";
            exit();
        }

        $result = $user->addUser($conn);
        // Execute the statement
        if ($result) {
            echo '<p style="color:green"> Đăng ký tài khoản thành công</p>';;
        } else {
            echo "Đăng ký tài khoản thất bại. Vui lòng thử lại.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
</head>

<body>

    <span>
        <Button>
            <a href="../pages/homepage.php">Trở về trang chủ</a>
        </Button>
    </span>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
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

        require_once(__DIR__ . "/../../../index.php");

        // Check the connection
        if (!$conn) {
            echo "Connect to DB Fail <br>";
            exit();
        }

        // Insert data into the 'users' table 
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $hoten);
        $stmt->bindParam(':password', $hashPassword);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<p style="color:green"> Đăng ký tài khoản thành công</p>';;
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
    ?>

    <span>
        <Button>
            <a href="../homepage/homepage.php"> Trở về trang chủ</a>
        </Button>
    </span>

</body>

</html>

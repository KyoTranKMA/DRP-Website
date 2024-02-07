<?php

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get Connection DB and Classees defined
        require_once(__DIR__ . "/../index.php");
        // Retrieve form data using PHP
        $user = new User();
        $user->username = isset($_POST['username']) ? $_POST['username'] : '';
        $user->password = isset($_POST['password']) ? $_POST['password'] : '';
        $user->firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $user->lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $user->dateofbirth = isset($_POST['dateofbirth']) ? $_POST['dateofbirth'] : '';
        $user->email = isset($_POST['email']) ? $_POST['email'] : '';
        $user->country = isset($_POST['country']) ? $_POST['country'] : '';
        $user->gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        // Check the connection
        if (!$conn) {
            echo "Connect to DB Fail <br>";
            exit();
        }

        $result = $user->addUser($conn, $username, $password, $firstname, $lastname, $dateofbirth, $email, $country, $gender);
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
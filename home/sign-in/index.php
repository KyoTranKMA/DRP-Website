<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập</title>
</head>

<body>
    <h1>Đăng nhập vào hệ thống</h1>
    <form name="frmPost" action="post-form.php" method="post">
        <legend>Nhập thông tin</legend>
        <fieldset>
            <p>
                <label for="hoten"> Họ Tên </label>
                <input name="hoten" id="hotens" type="text" placeholder="Nhập Họ Tên" />
            </p>
            <p>
                <label for="password"> Mật Khẩu </label>
                <input name="password" id="passwords" type="password" placeholder="Nhập Mật Khẩu" />
            </p>
            <p>
                <input type="submit" value="Login" />
                <input type="reset" value="Cancel" />
            </p>
        </fieldset>
    </form>
</body>

</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['hoten'];
        $password = $_POST['password'];
        if ($username == "admin" && $password == "admin") {
            $cookie_name = "user";
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + 86400 * 3, "/"); // Set cookie for 3 days
        } else {
            echo "Vui lòng nhập lại tài khoản hoặc mật khẩu";
        }
    }
?>

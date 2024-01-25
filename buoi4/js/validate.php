<?
    $nameError = "";
    $emailError = "";
    $websiteError = "";

    if (isset($_POST["submit"])) {
        if (empty($_POST["name"])) {
            $nameError = "Name is required";
        }else{
            $name = $_POST['name'];
            if(!preg_match("/^[A-Za-z ]*$",$name)) {
                $nameError = "Only charecters and spaces are allowed";
            }
        }
        if (empty($_POST["email"])) {
            $emailError = "email is required";
        }else{
            $email = $_POST['email'];
            if(!preg_match("/^\\S+@\\S+\\.\\S+$/",$email)) {
                $emailError = "Email is invalid";
            }
        }
        if (empty($_POST["website"])) {
            $websiteError = "website is required";
        }else{
            $website = $_POST['website'];
            if(!preg_match("/^https?:\\/\\/(?:www\\.)?[-a-zA-Z0-9@:%._\\+~#=]{1,256}\\.[a-zA-Z0-9()]{1,6}\\b(?:[-a-zA-Z0-9()@:%_\\+.~#?&\\/=]*)$/"
            ,$website)) {
                $websiteError = "Only charecters and spaces are allowed";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {color: red;}
    </style>
</head>
<body>
    <form action="" method="post">
        <fieldset>
            <legend>Please fill out the following fiedls</legend>
            <p>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" placeholder="Your Name">
                <? echo "<span class='error'> $nameError </span>"?>
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="test@gmail.com">
                <? echo "<span class='error'> $emailError </span>"?>
            </p>
            <p>
                <label for="website">Website:</label>
                <input name="website" id="website" placeholder="https://yoursite.com">
                <? echo "<span class='error'> $websiteError </span>"?>
            </p>
            <p>
                <input type="submit" name="submit" value="Submit">
                <input type="reset">
            </p>
        </fieldset>
    </form>
</body>
</html>
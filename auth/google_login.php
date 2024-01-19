<?php


    // Get $client variable
    require(__DIR__ . "/../config/google_oauth.php");
    // Get Connection DB and Class
    require_once(__DIR__ . "/../index.php");  
    // Implement 
    $googleOAuthHandler = new Oauth($client);
    $login_url = $googleOAuthHandler->getLoginUrl();

    // Handle the callback
    $googleOAuthHandler->handleCallback($conn);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with Google account</title>
    <style>
        .btn {
            display: flex;
            justify-content: center;
            padding: 50px;
        }

        a {
            all: unset;
            cursor: pointer;
            padding: 10px;
            display: flex;
            width: 250px;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background-color:
                #f9f9f9;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 3px;
        }

        a:hover {
            background-color:
                #ffffff;
        }

        img {
            width: 50px;
            margin-right: 5px;

        }
    </style>
</head>

<body>
    <div class="btn">
        <a href="<?= $login_url ?>"><img src="../assets/image/google_logo.png" alt="Google Logo"> Login with Google</a>
    </div>
</body>

</html>
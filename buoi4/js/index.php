<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JQuery Demo</title>
    <scrip scr="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
    <scrip scr="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.9.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="./../css/style.css">
    <script src="js/script.js"></script>

</head>
<body>
    <div class="container">
        <form class="form" id="frmRefoForm" method="get" action="" name="frmRegForm" >
            <fieldset>
                <legend>Registration Form</legend> 
                <div class="row">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" minlength="2">
                </div>
                <div class="row">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" minlength="2">
                </div>
                <div class="row">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" minlength="2">
                </div>
                <div class="row">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" minlength="2">
                </div>
                <div class="row">
                    <label for="repassword">Confirm Password</label>
                    <input type="password" id="repassword" name="repassword" minlength="2">
                </div>
                <div class="row">
                    <label for="comment">Your comment</label></label>
                    <textarea type="text" id="comment" name="comment" minlength="2"></textarea>
                </div>
                <div class="row">
                    <input type="submit" class="btn" value="Registor">
                </div>                
            </fieldset>
        </form>   
   </div>
</body>
</html>
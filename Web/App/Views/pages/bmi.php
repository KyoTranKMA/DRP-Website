<? require_once($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BMI Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 500px;
            height: 450px;
            margin: 45px auto;
            padding: 40px;
            background-color: #064E3B;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;

        }

        .container img {
            width: 90px;
            margin-bottom: 20px;
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #34D399;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            -moz-appearance: textfield;
            -webkit-appearance: textfield;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            margin-top: 15px;
        }

        .unit {
            color: #FFFFFF;
        }

        button:hover {
            background-color: #45a049;
        }

        #result {
            margin-top: 20px;
            text-align: center;
            color: #ffffff; 
            background-color: #4CAF50; 
            padding: 10px;
            border-radius: 5px;
            font-family: Arial, sans-serif; 
            font-size: 18px;
            font-weight: bold; 
        }

  
    </style>
</head>

<body>
    <div class="container">
        <img src="/Public/images/logo.png" alt="">
        <h1>BMI Calculator</h1>

        <p class="unit">Height (in cm)</p>
        <input type="number" id="height" name="height" step="1" required><br>
        <p class="unit">Weight (in kg)</p>
        <input type="number" id="weight" name="weight" step="1" required><br>
        <button id="btn">Calculate</button>

        <div id="result"></div>
    </div>
    <script src="/Public/js/caculate-bmi.js"></script>
</body>

</html>


<?php require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php"); ?>
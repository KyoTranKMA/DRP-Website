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
            width: 400px;
            margin: 50px auto;
            padding: 20px;
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

        p {
            color: #FFFFFF;
        }

        button:hover {
            background-color: #45a049;
        }

        #result {
            margin-top: 20px;
            text-align: center;
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="/Public/images/logo.png" alt="">
        <h1>BMI Calculator</h1>

        <p>Height (in cm)</p>
        <input type="number" id="height" name="height" step="1" required><br>
        <p>Weight (in kg)</p>
        <input type="number" id="weight" name="weight" step="1" required><br>
        <button id="btn">Calculate</button>

        <div id="result"></div>
    </div>
    <script src="/Public/js/caculate-bmi.js"></script>
</body>

</html>
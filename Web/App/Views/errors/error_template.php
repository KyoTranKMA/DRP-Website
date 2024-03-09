<? require_once($_SERVER['DOCUMENT_ROOT' . '/Public/inc/header.php']) ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Error <?= $errorCode ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      color: #6c757d;
    }

    p {
      color: #6c757d;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Error <?= $errorCode ?></h1>
    <p>Sorry, an error has occurred. Please try again later.</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<? require_once($_SERVER['DOCUMENT_ROOT' . '/Public/inc/footer.php']) ?>
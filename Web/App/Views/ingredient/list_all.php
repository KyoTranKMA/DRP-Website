<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipe manager system</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 20px;
    }

    h3 {
      margin-bottom: 20px;
      color: #6c757d;
      text-align: center;
    }

    .table {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-left: auto;
      margin-right: auto;
    }

    th {
      background-color: #6c757d;
      color: white;
    }

    td, th {
      text-align: center;
      vertical-align: middle;
    }
  </style>
</head>

<body>
  <div class="container">
    <h3 class="text-center">Ingredient manager</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Category</th>
          <th scope="col">Calcium</th>
          <th scope="col">Calories</th>
          <th scope="col">Carbohydrate</th>
          <th scope="col">Cholesterol</th>
          <th scope="col">Fiber</th>
          <th scope="col">Iron</th>
          <th scope="col">Fat</th>
          <th scope="col">Monounsaturated fat</th>
          <th scope="col">Polyunsaturated fat</th>
          <th scope="col">Saturated fat</th>
          <th scope="col">Potassium</th>
          <th scope="col">Protein</th>
          <th scope="col">Sodium</th>
          <th scope="col">Sugar</th>
          <th scope="col">Vitamin A</th>
          <th scope="col">Vitamin C</th>
        </tr>
      </thead>
      <tbody>
        <?php static $i=1; foreach ($data as $ingredient) : ?>
          <tr>
            <th scope="row"><?echo $i++?></th>
            <td><?= $ingredient->getId() ?></td>
            <td><?= $ingredient->getName() ?></td>
            <td><?= $ingredient->getCategory() ?></td>
            <?php foreach ($ingredient->getNutritionComponents() as $nutrition): ?>
              <td><?= $nutrition ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
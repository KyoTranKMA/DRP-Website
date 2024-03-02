<?
  require_once(ROOT_PATH . 'App/Core/init.php');
  $Ingredients = new App\Models\IngredientModel();
  $data = $Ingredients->all('ingredients', ['*']);

  
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipe manager system</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h3>Ingredient manager</h3>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Category</th>
          <th scope="col">Nutrition components</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($Ingredients->all('ingredients', ['*']) as $ingredient) : ?>
          <tr>
            <th scope="row">1</th>
            <td><?= $ingredient->getId() ?></td>
            <td><?= $ingredient->getName() ?></td>
            <td><?= $ingredient->getCategory() ?></td>
            <td><?= implode(', ', $ingredient->getNutritionComponents()) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
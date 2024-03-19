<? require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/header.php'); ?>
  <style>
    .container {
      margin-top: 20px;
    }

    h4 {
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
  <div class="container">
    <h4 class="text-center">Ingredient manager</h4>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Category</th>
          <th scope="col">Measurement unit</th>
        </tr>
      </thead>
      <tbody id="ingredientTableBody">
        <?php static $i=1; foreach ($data as $ingredient) : ?>
          <tr>
            <th scope="row"><?echo $i++?></th>
            <td><?= $ingredient->getId() ?></td>
            <td><?= $ingredient->getName() ?></td>
            <td><?= $ingredient->getCategory() ?></td>
            <td><?php switch($ingredient->getMeasurementDescription()) {
              case 'g': echo 'Gram'; break;
              case 'kg': echo 'Kilogram'; break;
              case 'ml': echo 'Milliliter'; break;
              case 'l': echo 'Liter'; break;
              case 'tsp': echo 'Teaspoon'; break;
              case 'tbsp': echo 'Tablespoon'; break;
              case 'cup': echo 'Cup'; break;
              case 'pint': echo 'Pint'; break;
              case 'quart': echo 'Quart'; break;
              case 'gallon': echo 'Gallon'; break;
              case 'oz': echo 'Ounce'; break;
              case 'lb': echo 'Pound'; break;
              case 'mg': echo 'Milligram'; break;
              case 'mcg': echo 'Microgram'; break;
              case 'IU': echo 'International Unit'; break;
              case 'can': echo 'Can'; break;
              case 'unit': echo 'Unit'; break;
              default: echo 'Unknown';
            } ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div id="loadMoreContainer" class="text-center">
      <button id="loadMoreButton" class="btn btn-primary">Load More</button>
    </div>
  </div>

<? require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/footer.php'); ?>
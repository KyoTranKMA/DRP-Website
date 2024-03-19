function viewIngredient(ingredients) {
  // Parse JSON data into JavaScript object
  var ingredients = JSON.parse(ingredients);


// Xóa dữ liệu cũ trong bảng
$(".ingredientTableBody").empty();

// Duyệt qua mảng ingredients để thêm dữ liệu mới vào bảng
$.each(ingredients, function (index, ingredient) {
  // Xây dựng hàng của bảng
  var row = "<tr>" +
              "<td>" + ingredient.id + "</td>" +
              "<td>" + ingredient.name + "</td>" +
              "<td>" + ingredient.category + "</td>" +
              "<td>";

  // Chuyển đổi đơn vị đo lường
  switch (ingredient.measurement_description) {
    case 'g':
      row += 'Gram';
      break;
    case 'kg':
      row += 'Kilogram';
      break;
    case 'ml':
      row += 'Milliliter';
      break;
    case 'l':
      row += 'Liter';
      break;
    case 'tsp':
      row += 'Teaspoon';
      break;
    case 'tbsp':
      row += 'Tablespoon';
      break;
    case 'cup':
      row += 'Cup';
      break;
    case 'pint':
      row += 'Pint';
      break;
    case 'quart':
      row += 'Quart';
      break;
    case 'gallon':
      row += 'Gallon';
      break;
    case 'oz':
      row += 'Ounce';
      break;
    case 'lb':
      row += 'Pound';
      break;
    case 'mg':
      row += 'Milligram';
      break;
    case 'mcg':
      row += 'Microgram';
      break;
    case 'IU':
      row += 'International Unit';
      break;
    case 'can':
      row += 'Can';
      break;
    case 'unit':
      row += 'Unit';
      break;
    default:
      row += 'Unknown';
  }

  row += "</td></tr>";

  // Thêm hàng vào tbody của bảng
  $(".ingredientTableBody").append(row);
});
}


var page = 1;

$(function () {
getIngredient();
});

$("#show").click(function () {
page++;
getIngredient(page);
});

function getIngredient(page = 1) {
$("#show").text("Next...");
$.ajax({
  type: "GET",
  url: "/ingredients/?page=" + page,
  dataType: "json",
  success: function (ingredients) {
    viewIngredient(ingredients);
    var ingredientPerPage = 20; 

    if (ingredients.length < ingredientPerPage) {
      $("#show").fadeOut(1000);
    }
  },
});
}
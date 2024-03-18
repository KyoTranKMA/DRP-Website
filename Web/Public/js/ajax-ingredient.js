
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
    success: function (ingredient) {
      // Hiển thị công thức
      viewIngredient(ingredient);
      var ingredientPerPage = 12; // Số lượng công thức hiển thị trên mỗi trang

      // Trong hàm getRngredient:
      if (ingredient.length < ingredientPerPage) {
        $("#show").fadeOut(1000);
      }
    },
  });
}

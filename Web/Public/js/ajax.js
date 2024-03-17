// Hàm xử lý hiển thị công thức dựa trên dữ liệu
function viewRecipes(data) {
  // Parse JSON data into JavaScript object
  var recipes = JSON.parse(data);

  // Container để chứa các thẻ công thức
  var recipeContainer = $(".d-flex.flex-wrap");

  // Duyệt qua mỗi công thức và thêm vào container
  $.each(recipes, function (index, recipe) {
    // Tạo thẻ div chứa thông tin của mỗi công thức
    var recipeDiv = $(
        '<div class="card col-md-8" style="width: 22.5%; height: 25rem; margin: 1rem 1.25%">' +
          '<img src="/Public/uploads/recipes/' +
          (recipe.image_url ? recipe.image_url : "image_not_found.png") +
          '" class="card-img-top" alt="Picture of meal" style="object-fit: cover; height:12rem">' +
          '<div class="card-content" style="height:10rem">'+
            '<div class="card-body">' +
            '<h3 class="card-title">' +
            recipe.name +
            "</h3>" +
            '<p class="card-text">' +
            recipe.description +
            "</p>" +
            // Thêm data attribute để lưu trữ thông tin chi tiết của công thức
            '<div class="card-details" style="display: none;" data-details=\'' +
            JSON.stringify(recipe) +
            // "'></div>" +
            // "'</div>"+
          '<div class="card-footer d-flex align-items-center" style="border: none; background-color: white; padding: 0;">' +
          '<i class="fa-solid fa-clock-rotate-left"></i>' +
          '<p style="margin: 0;padding-left: 8px;">' +
          recipe.preparation_time_min +
          " mins</p>" +
          "</div>" +
          '<div class="rating"></div>' + // Thẻ div để chứa rating
          "</div>" +
          "</div>"+
        '</div>'
    );

    // Thêm thẻ div vào container
    recipeContainer.append(recipeDiv);

    // Thêm rating ảo
    var rating = Math.floor(Math.random() * 3) + 3; // Tạo số rating ngẫu nhiên từ 0 đến 5
    for (var i = 0; i < 5; i++) {
      if (i < Math.floor(rating)) {
        // Thêm sao màu vàng cho các rating nguyên
        recipeDiv
          .find(".rating")
          .append('<i class="fa-solid fa-star" style="color: gold;"></i>');
      } else if (i === Math.floor(rating) && rating % 1 !== 0) {
        // Nếu rating không phải là số nguyên, thêm nửa sao màu vàng
        recipeDiv
          .find(".rating")
          .append('<i class="fa-solid fa-star-half" style="color: gold;"></i>');
      } else {
        // Thêm sao trống cho các rating còn lại
        recipeDiv
          .find(".rating")
          .append('<i class="fa-regular fa-star" style="color: gold;"></i>');
      }
    }
  });


}

var page = 1;

$(function () {
  getRecipes();
});

$("#show").click(function () {
  page++;
  getRecipes(page);
});

function getRecipes(page = 1) {
  $("#show").text("Next...");
  $.ajax({
    type: "GET",
    url: "/recipes/?page=" + page,
    dataType: "json",
    success: function (recipes) {
      // Hiển thị công thức
      viewRecipes(recipes);
      var recipesPerPage = 12; // Số lượng công thức hiển thị trên mỗi trang

      // Trong hàm getRecipes:
      if (recipes.length < recipesPerPage) {
        $("#show").fadeOut(1000);
      }
    },
  });
}

// Hàm xử lý hiển thị công thức dựa trên dữ liệu
function viewRecipes(data) {
    // Parse JSON data into JavaScript object
    var recipes = JSON.parse(data);

    // Duyệt qua mỗi công thức và thêm vào container
    $.each(recipes, function (index, recipe) {
        // Tạo thẻ div chứa thông tin của mỗi công thức
        var recipeDiv = $('<div class="card col-md-8" style="width: 18rem;">' +
                            '<img src="/Public/uploads/recipes/' + recipe.image + '" class="card-img-top" alt="...">' +
                            '<div class="card-body">' +
                                '<h3 class="card-title">' + recipe.name + '</h3>' +
                                '<p class="card-text">' + recipe.description + '</p>' +
                                // Thêm data attribute để lưu trữ thông tin chi tiết của công thức
                                '<div class="card-details" style="display: none;" data-details=\'' + JSON.stringify(recipe) + '\'></div>' +
                                '<div class="card-footer d-flex align-items-center" style="border: none; background-color: white; padding: 0;">' +
                                    '<i class="fa-solid fa-clock-rotate-left"></i>' +
                                    '<p style="margin: 0;padding-left: 8px;">' + recipe.preparation_time_min + ' mins</p>' +
                                '</div>' +
                                '<div class="rating"></div>' +
                            '</div>' +
                        '</div>');

        // Thêm thẻ div vào container
        $('.d-flex.flex-wrap.justify-content-between').append(recipeDiv);
    });

    // Thêm sự kiện click cho các thẻ để hiển thị thông tin chi tiết khi người dùng nhấp vào
    $('.card').click(function() {
        // Lấy thông tin chi tiết của công thức từ data attribute
        var details = $(this).find('.card-details').data('details');
        // Hiển thị thông tin chi tiết của công thức
        $(this).find('.card-text').text(details.description);
        // Ẩn ảnh để làm cho công thức hiển thị đẹp hơn
        $(this).find('.card-img-top').hide();
        // Ẩn nút chi tiết để tránh người dùng nhấp nhiều lần
        $(this).find('.card').hide();
    });

    
}


// Hàm tạo phần đầu bảng
function head_table() {
    // Tạo hàng đầu tiên của bảng để hiển thị tiêu đề các cột
    $('#tblRecipes thead').html('<tr>' +
        '<th>Name</th>' +
        '<th>Description</th>' +
        '<th>Preparation Time</th>' +
        '<th>Cooking Time</th>' +
        '<th>Directions</th>' +
        '<th>Meal Type 1</th>' +
        '<th>Meal Type 2</th>' +
        '<th>Meal Type 3</th>' +
        '</tr>');
}

// Hàm tạo phần cuối bảng
function foot_table(total) {
    // Hiển thị tổng số công thức trong bảng
    $('#totalRecipes').text('Total Recipes: ' + total);
}

var page = 1;

$(function () {
    getRecipes();
});

$('#show').click(function () {
    page++;
    getRecipes(page);
});

function getRecipes(page = 1) {
    $('#show').text("Next...");
    $.ajax({
        type: "GET",
        url: "/recipe/?page=" + page,       
        dataType: "json",
        success: function (recipes) {
            // Hiển thị công thức
            viewRecipes(recipes);
            
            // Hiển thị phần đầu bảng nếu chưa tồn tại
            if ($('#tblRecipes thead').is(':empty')) {
                head_table();
            }
            
            // Hiển thị phần cuối bảng
            foot_table(recipes.length);
            
            // Ẩn nút nếu không còn công thức để tải
            if (recipes.length < 15) {
                $('#show').fadeOut(3000);
            }
            
            // Thay đổi text của nút
            $('#show').text("Load more");
        }
    });
}

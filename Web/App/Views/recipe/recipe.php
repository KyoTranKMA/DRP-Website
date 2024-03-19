<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/header.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recipes</title>
</head>
<body>
    <div class="container mt-3">
        <div class="row" style="width: 100%;">
            <h3 class="d-flex justify-content-center">Easy recipes for your meal</h3>
            <div class="d-flex flex-wrap justify-content-start" id="recipeContainer">
            </div>
        </div>
    </div>
    <div class="form" style="margin-left:50%">
        <button id="show" class="btn btn-primary">OK</button>
    </div>
    <script src="/Public/js/libs/jquery/jquery-3.6.0.min.js"></script>
    <script src="/Public/js/ajax-recipe.js"></script>
    <script>
        $(document).ready(function() {
            $('#recipeContainer').on('click', '.card', function() {
                // Lấy dữ liệu từ thuộc tính data-details của thẻ card được bấm vào
                var recipeDetails = $(this).find('.card-details').data('details');

                window.location.href = "/recipe/detail?details=" + encodeURIComponent(JSON.stringify(recipeDetails));
            });
        });
    </script>

</html>


<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/footer.php'); ?>
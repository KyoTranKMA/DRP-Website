<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/header.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .header-space {
            height: 40px;
        }
    </style>
    <title>Recipes</title>
</head>


<body>
    <div class="header-space"></div>
    <div class="container">
        <div class="row" style="width: 100%;">
            <div class="d-flex flex-wrap justify-content-start" id="recipeContainer">
            </div>
        </div>
    </div>
    <div class="row">
        <button id="show" class="btn">OK</button>
    </div>
    <script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/Public/js/ajax.js"></script>
    <script>
        recipeDiv.click(function() {
            // Lấy slug của công thức từ object recipe
            var slug = recipe.slug;
            // Chuyển hướng đến trang chi tiết công thức với slug tương ứng
            window.location.href = "/recipe/show?slug=" + slug;
        });
    </script>

</body>



<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/footer.php'); ?>
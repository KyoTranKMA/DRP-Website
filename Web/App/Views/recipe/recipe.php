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
            <div class="d-flex flex-wrap justify-content-between" id="recipeContainer">
            </div>
        </div>
    </div>
    <div class="row">
        <button id="show" class="btn">OK</button>
    </div>
    <script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/Public/js/ajax.js"></script>
    <script>
        $(document).ready(function() {
            // Thêm sự kiện click cho thẻ .card
            $('#recipeContainer').on('click', '.card', function() {
                // Lấy mô tả từ thuộc tính data-description của thẻ .card
                var description = $(this).data('description');

                // Hiển thị mô tả đầy đủ
                alert(description);
            });
        });
    </script>

</body>



<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/footer.php'); ?>
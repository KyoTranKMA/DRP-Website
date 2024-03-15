<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/header.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Public/css/style.css">
    <title>Recipes</title>
</head>

<body>
    <div class="container">
        <div class="row" style="width: 100%;">
            <div class="d-flex flex-wrap justify-content-between" id="recipeContainer">
                <?php foreach ($ajax_data as $recipe) : ?>
                    <div class="card col-md-8" style="width: 18rem;" data-description="<?php echo $recipe['description']; ?>">
                    <img src="<?php echo $data['image']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title" style="height: 56px;"><?php echo $recipe['name']; ?></h3>
                            <div class="card-footer d-flex align-items-center" style="border: none; background-color: white; padding: 0;">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <p style="margin: 0;padding-left: 8px;">32 mins ago</p>
                            </div>
                            <div class="rating">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
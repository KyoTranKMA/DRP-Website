<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/header.php'); ?>
    <style>
        .header-space {
            height: 40px;
        }
    </style>

<body>
    <div class="header-space"></div>
    <div class="container">
        <div class="row" style="width: 100%;">
            <h3 class="d-flex justify-content-center">Easy recipes for your meal</h3>
            <div class="d-flex flex-wrap justify-content-start" id="recipeContainer">
            </div>
        </div>
    </div>
    <div class="form" style="margin-left:50%">
        <button id="show" class="btn btn-primary">OK</button>
    </div>
    <script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/Public/js/ajax.js"></script>
    <script>
          $(document).ready(function() {
            // Thêm sự kiện click cho thẻ .card
            $('#recipeContainer').on('click', '.card', function() {

                window.location.href = "/recipe/show";
            });
        });
    </script>




<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/footer.php'); ?>
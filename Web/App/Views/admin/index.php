<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/header.php'); ?>

<div class="container py-3">
  <div class="row">
    <div class="col-md-4">
      <div class="advert">
        <img src="/Public/images/account.png" class="img-thumbnail" alt="Ảnh user">
        <div class="link">    
            <a href="/manager/user" class="btn btn-secondary" tabindex="-1" role="button">Quản lý người dùng!</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="advert">
        <img src="/Public/images/recipe.png" class="img-thumbnail" style="height:415px" alt="ảnh recipe">
        <div class="link">
            <a href="/manager/recipe" class="btn btn-secondary" tabindex="-1" role="button">Quản lý công thức!</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="advert">
        <img src="/Public/images/ingredient.jpg" class="img-thumbnail" style="height:415px" alt="ảnh ingredient">
        <div class="link">
            <a href="/manager/ingredient" class="btn btn-secondary" tabindex="-1" role="button">Quản lý nguyên liệu!</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/footer.php'); ?>

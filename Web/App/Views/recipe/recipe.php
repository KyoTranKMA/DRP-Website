<? require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/header.php'); ?>
<div class="recipe">
    <div class="container">
        <?php array_shift($data); ?>
        <div class="row" style="width: 100%;">
            <div class="d-flex flex-wrap justify-content-start m-3" style="width: 100%;">
                <? foreach ($data as $recipe):?>
                <a href="#" class="card col-md-8" style="width: 22.5%; height: 25rem; margin: 1rem 1.25%">
                        <img src="/Public/uploads/recipes/<?echo $recipe->getImgUrl()?? "/images/no_image.jpg"?>" 
                        class="card-img-top" 
                        alt="Picture of meal" 
                        style="object-fit: cover; 
                        height:12rem">
                    <div class="card-body">
                        <div class="card-content" style="height:10rem">
                            <h4 class="card-title"><? echo htmlspecialchars($recipe->getName());?></h4>
                            <p class="card-text"><? echo $recipe->getDescription()?></p> 
                         </div>
                        <p class="card-text"><small class="text-muted">Date: <? echo $recipe->getTimestamp() ?></small></p>
                    </div>
                </a>
                <?endforeach;?>                
            </div>
        </div>
    </div>
</div>
<? require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/footer.php'); ?>
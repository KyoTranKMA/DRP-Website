<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php")?>

<div class="homepage">
    <div class="container mb-3">
        <div class="content d-flex align-items-start mt-3">
            <? $mainRecipe = $data[0]; ?>
            <div class="main-content flex-fill" style="position: sticky; top: 1rem">
                <div class="card" style="width: 45vw; height:83.5vh">
                    <a href="#">
                        <img src="/Public/uploads/recipes/<?echo $mainRecipe->getImgUrl() ?? "image_not_found.png" ; ?>" class="card-img-top" alt="Picture of meal" style="object-fit: cover; height:30rem">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><? echo $mainRecipe->getName() ?></h5>
                        <p class="card-text"><? echo $mainRecipe->getDescription() ?></p>
                        <a href="/recipe" class="btn btn-primary">Get recipe</a>
                    </div>
                </div>
            </div>
            <?php array_shift($data); ?>
            <div class="nav-content flex-fill ms-3">
                <? foreach ($data as $recipe):?>
                <div class="card mb-3" >
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/Public/uploads/recipes/<?echo $recipe->getImgUrl()?? "image_not_found.png"?>" class="card-img-bottom" alt="Picture of meal" style="object-fit: cover; height:12rem">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><? echo htmlspecialchars($recipe->getName());?></h5>
                                <p class="card-text"><? echo $recipe->getDescription()?></p>
                                <p class="card-text"><small class="text-muted">Date: <? echo $recipe->getTimestamp() ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php"); ?>
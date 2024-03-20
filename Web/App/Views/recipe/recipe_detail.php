<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/header.php'); ?>
<?
function getUnitText($value)
{
    switch ($value) {
        case 'tsp':
            return 'Teaspoon';
        case 'cup':
            return 'Cup';
        case 'tbsp':
            return 'Tablespoon';
        case 'g':
            return 'Gram';
        case 'lb':
            return 'Pound';
        case 'can':
            return 'Can';
        case 'oz':
            return 'Ounce';
        case 'unit':
            return 'Unit';
        default:
            return '';
    }
}
?>
<div class="recipe_detail">
    <div class="container mt-3" style="width:50%">
        <div class="row">
            <div class="d-flex flex-wrap flex-column justify-content-center" style="width: 100%;">
                <h2 class="">You Need To Make My Mom’s 15-Minutes Creamed Tacos for Dinner</h2>
                <p class="">It’s a family favorite, passed down from Mrs. Hays in the 1960s.</p>
                <div class="author-info d-flex align-items-center">
                    <img src="https://i.pinimg.com/564x/8f/1a/b1/8f1ab1e2ef48c2a26de7df6e977930bd.jpg" alt="">
                    <div class="des">
                        <h5>By Mary Maris</h5>
                        <span>Updated March 13, 2024</span>
                    </div>
                </div>

                <img src="/Public/uploads/recipes/<? echo $data->getImgUrl() ?? "image_not_found.png" ?>" alt="<?php echo $data->getName() ?>" style="width: 100%; aspect-ratio: 3/4;">
                <div class="table-info mb-3">
                    <div class="title-table">RECIPE</div>
                    <div class="recipe-name"> <?php echo $data->getName() ?> </div>
                    <div class="time d-flex justify-content-between m-3">
                        <div class="pre-time">
                            <div class="time-title">Prep time</div>
                            <div class="time-detail"> <?php echo $data->getPreparationTime() ?> mins</div>
                        </div>
                        <div class="cook-time">
                            <div class="time-title">Cook time</div>
                            <div class="time-detail"> <?php echo $data->getCookingTime() ?> mins</div>
                        </div>
                        <div class="total-time">
                            <div class="time-title">Total time</div>
                            <div class="time-detail"> <?php echo $data->getPreparationTime() + $data->getCookingTime() ?> mins</div>
                        </div>
                    </div>

                    <h4 class="section__title section__title--bold-underline" data-title-tag="">Ingredients</h4>
                    <div class=" m-3">
                        <? $index = 1;?>
                        <? foreach ($data->getIngredientComponets() as $ingredient) : ?>
                            <p><?php echo $index++ . ". " . $ingredient['ingredient_name'] . " - " .  $ingredient['quantity'] . " " . getUnitText($ingredient['unit']); ?></p>
                        <? endforeach; ?>
                    </div>

                </div>


                <div class="intruction mb-3">
                    <h3>How to make it</h3>
                    <p>
                        <?php echo $data->getDirection() ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/footer.php'); ?>
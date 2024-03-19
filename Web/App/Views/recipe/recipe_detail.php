<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/header.php'); ?>

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

                <img src="/Public/uploads/recipes/<?echo $data->getImgUrl() ?? "image_not_found.png" ?>" alt="<?php echo $data->getName() ?>" style="width: 100%; aspect-ratio: 3/4;">
                <div class="table-info">
                    <div class="title-table">RECIPE</div>
                    <div class="recipe-name"> <?php echo $data->getName() ?> </div>
                    <div class="time d-flex justify-content-between m-3">
                        <div class="pre-time">
                            <div class="time-title">Prep time</div>
                            <div class="time-detail"> <?php echo $data->getPreparationTime() ?> mins</div>
                        </div>
                        <div class="cook-time">
                            <div class="time-title">Cook time</div>
                            <div class="time-detail"> <?php echo $data->getCookingTime() ?>   mins</div>
                        </div>
                        <div class="total-time">
                            <div class="time-title">Total time</div>
                            <div class="time-detail">  <?php echo $data->getPreparationTime() + $data->getCookingTime() ?>   mins</div>
                        </div>
                    </div>
                </div>


                <div class="intruction">
                    <h3>How to make it</h3>
                    <p>
                        I always run into bran muffins while traveling. They’re usually the only muffin flavor that’s still left in the case when I’m dashing through the train station or airport at odd hours of the day. Ever hopeful, I quickly purchase one to bring along and regret it as soon as I settle in my seat and take a bite.

                        Let’s face it. Most people wouldn’t notice if you changed the name of bran muffins to bland muffins. But they don't have to be dense and tasteless! It turns out they can be 5malty, nutty, and sweet, like a honey graham cracker—but even better because they’re moist and fluffy.

                        With tangy buttermilk, applesauce or mashed banana (you get to choose), floral honey, and rich butter, every ingredient in this recipe works double duty—function and flavor—to make bran muffins a breakfast or snack you’ll look forward to.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/Public/inc/footer.php'); ?>
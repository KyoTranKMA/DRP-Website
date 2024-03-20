<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Manager Recipe</title>
</head>
<body>
    <div class="container py-3" style="width: 100vw; margin: 0 auto; padding: 20px; border: 1px solid #e1ebfa; border-radius: 10px; box-shadow: 0 0 10px 0 #e1ebfa; margin-top: 50px; margin-bottom: 50px;">
        <div class="container py-2">
            <div class="py-3 text-center">
                <h1 class="display-1">Manager recipe</h1>
            </div>
        </div>
        <div class="row g-3">    
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span>List recipe</span>
            </h4>
            <div class="col-md-auto sign-up">
                <form action="/manager/user" method="GET" class="row g-3">
                    <div class="col-auto">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="s_id" name="s_id" placeholder="ID...">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-200" id="s_username" name="s_username" placeholder="Username...">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="s_email" name="s_email" placeholder="Email...">
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-success" name="search" type="submit">Search</button>
                    </div>
                </form>
            </div>

            <div class="col-md-auto">
                <table class="table table-bordered nav">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Preparation Time Min</th>
                        <th scope="col">Cooking Time Min</th>
                        <th scope="col">Directions</th>            
                        <th scope="col">Meal Type 1</th>
                        <th scope="col">Meal Type 2</th>
                        <th scope="col">Meal Type 3</th>
                        <th scope="col">Action</th>
                    </tr>
                    <?php $count = 0; 
                    if(!is_array($recipes)){
                        $recipes = [$recipes];
                    }
                    foreach ($recipes as $recipe): 
                        $count++;
                        if ($count > 10):
                            break;
                        endif;?>
                        <tr>
                            <td><?= $count?></td>
                            <td><?= $recipe->getId()?></td>
                            <td><?= $recipe->getName()?></td>
                            <td><?= $recipe->getDescription()?></td>
                            <td><img src="/Public/uploads/recipes/<?echo $recipe->getImgUrl() ?? "image_not_found.png" ; ?>" alt="<?php echo $recipe->getName(); ?>" width="100px" height="100"></td>
                            <td><?= $recipe->getPreparationTime()?></td>
                            <td><?= $recipe->getCookingTime()?></td>
                            <td><?= $recipe->getDirection()?></td>
                            <td><?= $recipe->getMealType1()?></td>
                            <td><?= $recipe->getMealType2()?></td>
                            <td><?= $recipe->getMealType3()?></td>
                            <td>
                                <a href="/manager/recipe/update?id=<?= $recipe->getId() ?>" class="btn btn-secondary d-inline-block" role="button">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="d-grid gap-2">
                <a href="/recipe/add" class="btn btn-success" tabindex="-1" role="button">Add recipe</a>
            </div>
            <div class="d-md-flex justify-content-md-end py-3">
                    <a href="/manager" class="btn btn-secondary me-md-2" tabindex="-1" role="button">Back</a>
            </div>
        </div>
    </div>
    <footer class="site-footer">
        <? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php")?>  
    </footer>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/Public/js/validate-signup.js"></script>
</body>
</html>
<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Manager Ingredient</title>
</head>
<body>
    <div class="container py-3" style="width: 100vw; margin: 0 auto; padding: 20px; border: 1px solid #e1ebfa; border-radius: 10px; box-shadow: 0 0 10px 0 #e1ebfa; margin-top: 50px; margin-bottom: 50px;">
        <div class="container py-2">
            <div class="py-3 text-center">
                <h1 class="display-1">Manager Ingredient</h1>
            </div>
        </div>
        <div class="row g-3">    
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span>List ingredient</span>
            </h4>
            <!-- SEARCH -->
            <div class="col-md-auto sign-up">
                <form action="/manager/ingredient" method="GET" class="row g-3">
                    <div class="col-auto">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" name="id" placeholder="ID...">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="category" name="category" placeholder="Category...">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="measurement_desciption" name="measurement_desciption" placeholder="Measurement Desciption...">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name...">
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-success" name="search" type="submit">Search</button>
                    </div>
                </form>
            </div>

            <!-- TABLE -->
            <div class="col-md-auto">
                <table class="table table-bordered nav">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category</th>
                        <th scope="col">Measurement Desciption</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    <?php $count = 0; 
                    if(!is_array($ingredients)){
                        $ingredients = [$ingredients];
                    }
                    foreach ($ingredients as $ingredient): 
                        $count++;
                        if ($count > 10):
                            break;
                        endif;?>
                        <tr>
                            <td><?= $ingredient->getId()?></td>
                            <td><?= $ingredient->getCategory()?></td>
                            <td><?= $ingredient->getMeasurementDescription()?></td>
                            <td><?= $ingredient->getName()?></td>
                            <td>
                                <?if($ingredient->getActive()):?>
                                    <form class="d-inline-block" action="/manager/ingredient" method="POST">
                                        <input type="hidden" name="id" value="<?= $ingredient->getId() ?>">
                                        <input type="hidden" name="isActive" value="0">
                                        <button class="btn btn-danger" style="width: 150px" type="submit">Unset Active</button>
                                    </form>
                                <?else:?>
                                    <form class="d-inline-block" action="/manager/ingredient" method="POST">
                                        <input type="hidden" name="id" value="<?= $ingredient->getId() ?>">
                                        <input type="hidden" name="isActive" value="1">
                                        <button class="btn btn-success" style="width: 150px" type="submit">Set Active</button>
                                    </form>
                                <?endif;?>
                                <a href="/manager/ingredient/update?id=<?= $ingredient->getId() ?>" class="btn btn-secondary d-inline-block" role="button">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="d-grid gap-2">
                <a href="/ingredient/add" class="btn btn-success" tabindex="-1" role="button">Add ingredient</a>
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
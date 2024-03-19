<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Manager User</title>
</head>
<body>
    <div class="container">
        <div class="container py-2">
            <div class="py-3 text-center">
                <h1 class="display-1">Manager User</h1>
            </div>
        </div>
        <div class="row g-3">    
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span>List user</span>
            </h4>
            <div class="col-md-auto">
                <table class="table table-bordered nav">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Date of birth</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>            
                        <th scope="col">Level</th>
                        <th scope="col">Actions</th>
                    </tr>
                    <?php $count = 0; 
                    foreach ($users as $user): 
                        if ($user->getLevel() > 1):
                            $count++;?>
                        <tr>
                            <td><?= $count?></td>
                            <td><?= $user->getId() ?></td>
                            <td><?= $user->getUsername() ?></td>
                            <td><?= $user->getFirstName()?></td>
                            <td><?= $user->getLastName()?></td>
                            <td><?= $user->getDateOfBirth()?></td>
                            <td><?= $user->getEmail() ?></td>
                            <td><?= $user->getGender()?></td>
                            <td><?= $user->getLevel() ?></td>
                            <td>
                                <!-- btn: Set Contribute, Unset Contribute and Is Ban -->
                                <?php if ($user->getLevel() == 3): ?>
                                    <form class="d-inline-block" action="/manager/user" method="POST">
                                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                        <input type="hidden" name="level" value="2">
                                        <button class="btn btn-success" style="width: 170px" type="submit">Set Contributor</button>
                                    </form>
                                <?php elseif ($user->getLevel() == 2): ?>
                                    <form class="d-inline-block" action="/manager/user" method="POST">
                                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                        <input type="hidden" name="level" value="3">
                                        <button class="btn btn-warning" style="width: 170px" type="submit">Unset Contributor</button>
                                    </form>
                                <?php else: ?>
                                    <button class="d-inline-block btn btn-outline-danger" style="width: 170px" disabled>Is Ban</button>
                                <?php endif; ?>
                                
                                <!-- btn: Edit user -->

                                <a href="/manager/user/update?id=<?= $user->getId() ?>" class="btn btn-secondary d-inline-block" role="button">Edit</a>
                                <!-- btn: Ban and Unban -->
                                <?php if ($user->getLevel() != 4): ?>
                                    <form class="d-inline-block" action="/manager/user" method="POST">
                                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                        <input type="hidden" name="level" value="4">
                                        <button class="btn btn-danger" style="width: 100px" type="submit">Ban</button>
                                    </form>  
                                <?php elseif ($user->getLevel() == 4): ?>
                                    <form class="d-inline-block" action="/manager/user" method="POST">
                                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                        <input type="hidden" name="level" value="3">
                                        <button class="btn btn-info" style="width: 100px" type="submit">Unban</button>
                                    </form>
                                <?php endif;?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
                <!-- <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav> -->
            </div>
            <div class="col-md-auto sign-up">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span>Add new user</span>
                </h4>
                <form id="sign-up-form" action="/manager/user/add" method="POST" class="row g-3">
                    <div class="col-auto">
                        <label for="username" class="col-sm-auto col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control w-200" id="username" name="username">
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="col-auto">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-success" name="update" type="submit">Add</button>
                    </div>
                </form>
                <div class="d-md-flex justify-content-md-end py-3">
                    <a href="/manager" class="btn btn-secondary me-md-2" tabindex="-1" role="button">Back</a>
                </div>
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
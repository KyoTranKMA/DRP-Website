<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Manager User</title>
</head>
<body>
    <h1 class="display-1">Manager User</h1>
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

    <a href="/logout" class="btn btn-primary" tabindex="-1" role="button">Logout</a>

    <!-- <script>
        // JavaScript functions for actions
        function setContributor(userId) {
            $.ajax({
                url: '/manager/user/setContribute',
                method: 'POST',
                data: { id: userId },
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }

        function unSetContributor(userId) {
            // Implement logic to set the user with the specified userId as a contributor
            alert('Setting user with ID ' + userId + ' as a contributor');
        }
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
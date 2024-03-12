<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Admin Management</title>
</head>
<body>
    <h1>Admin Management Page</h1>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): 
            if ($user->getLevel() > 1):?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td><?= $user->getUsername() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getLevel() ?></td>
                <td>
                    <?if ($user->getLevel() == 3)?>
                        <form action="/manager/user/setLevel" method="POST">
                            <input type="hidden" name="id" value="<?= $user->getId() ?>">
                            <input type="hidden" name="level" value="2">
                            <button type="submit">Set Contributor</button>
                        </form>
                        <?else :?>
                        <form action="/manager/user/setLevel" method="POST">
                            <input type="hidden" name="id" value="<?= $user->getId() ?>">
                            <input type="hidden" name="level" value="3">
                            <button type="submit">Unset Contributor</button>
                        </form>
                </td>
            </tr>
            <?endif?>
        <?php endforeach; ?>
    </table>

    <a href="/logout">Logout</a>

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
</body>
</html>
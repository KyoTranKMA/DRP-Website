<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <?if ($user->getLevel() == 3):?>
                        <button onclick="setContributor(<?= $user->getId() ?>)">Set Contributor</button>
                    <?else :?>
                        <button onclick="setContributor(<?= $user->getId() ?>)">Unset Contributor</button>
                    <?endif?>
                </td>
            </tr>
            <?endif?>
        <?php endforeach; ?>
    </table>

    <script>
        // JavaScript functions for actions
        function banUser(userId) {
            // Implement logic to ban the user with the specified userId
            alert('Banning user with ID ' + userId);
        }

        function setContributor(userId) {
            // Implement logic to set the user with the specified userId as a contributor
            alert('Setting user with ID ' + userId + ' as a contributor');
        }
    </script>
</body>
</html>
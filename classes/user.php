<?php
class User
{
    // Delcare Propertys of DB
    public $id;
    public $username;
    public $password;

    // Authentication User
    public static function authenticate($connection, $username, $password)
    {
        $sql = "SELECT * FROM users WHERE username=:username";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            $hash = $user->password;
            // Check password input with password Hash
            if (password_verify($password, $hash)) {
                // Return user to get id
                return $user;
            }
        }
        // Return false if the user is not found 
        return false;
    }
}

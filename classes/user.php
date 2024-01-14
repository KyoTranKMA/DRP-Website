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
        echo $username ."".$password."";
        $sql = "SELECT * FROM users WHERE username=:username";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            $hash = $user->password;
            // Check password input with password Hash
            return password_verify($password, $hash);
        }

        // Return false if the user is not found 
        return false;
    }
}

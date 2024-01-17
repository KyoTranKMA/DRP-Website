<?php
class User
{
    // Delcare Propertys of DB
    public $id;
    public $username;
    public $password;
    public $userTbl;
    // Authentication User
    public static function authenticate($connection, $username, $password)
    {
        $userTbl = 'users';
        $sql = "SELECT * FROM $userTbl WHERE username=:username";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            $passwordInDB = $user->password;

            // Check password input with password Hash
            if (password_verify($password, $passwordInDB)) {
                // Return user to get id
                return $user;
            }
        }
        // Return false if the user is not found 
        return false;
    }
  
}

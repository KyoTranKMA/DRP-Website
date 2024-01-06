<?
    class User{
        // Delcare Propertys of DB
        public $id;
        public $username;
        public $password;


        // Authentication User
        public static function authenticate($connection, $username, $password)
        {
            $sql = "select * from user where username=:username";

            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':username',$username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $stmt->execute();
            $user = $stmt->fetch();

            if($user)
            {
                $hash = $user->password;
                // Check password input with password Hash
                return password_verify($password, $hash);

            }

            // Return false if the user not found 
            return false;

        }
    }

?>



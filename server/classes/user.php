<?php
class User
{
    // Delcare Propertys of DB
    public $id;
    public $username;
    public $password;

    private function validate(){
        return $this->username !=  '' && $this->password != ''; 
    } 

    // Authentication User
    public static function authenticate($connection, $username, $password)
    {
        $sql = "select * from users where username=:username";

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
    
    // Add new Users
    public function addUser($connection){
        if($this->validate()){
            // Insert data into the 'users' table 
            $sql = "insert into users (username, password) values (:username, :password)";
            // Prepare the statement
            $stmt = $connection->prepare($sql);

            // Bind parameters
            $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
            $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bindValue(':password', $hashPassword, PDO::PARAM_STR);
            return $stmt->execute();
        }
        // If Username and PassWord not valid
        return false;
    }

}

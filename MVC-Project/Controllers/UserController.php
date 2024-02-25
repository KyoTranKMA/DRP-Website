<?php
class UserController
{
    /*
        This class is manager 
            authenticate(): Login
            addUser(): Register
    */
    public $username;
    public $password; 
    public $firstname;
    public $lastname;
    public $dateofbirth;
    public $email;
    public $country;
    public $gender;
    public $connection;

    private function checkEmail($email){
        $sql = "select from users where email=:email LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user)
        {
            return true;
        } 
        return false;
    }

    private function checkUserName($username){
        $sql = "select from users where username=:username LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) 
        {
            return true;
        }
        return false;
    }

    // Authenticate user (login)
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

    public function addUser($connection,$username, $password, $firstname , $lastname, $dateofbirth, $email, $country, $gender){
        $this->connection = $connection;

        // check username and email has been
        if ($username == '' || $password == '' || $dateofbirth == '' || $email == '' || $country == '' || $gender == ''){
            $alert = 'Fields must be not empty!';
            return $alert;
        } else {
            if ($this->checkEmail($email)){
                $alert = 'Email Already Existed';
                return $alert;
            };
            if ($this->checkUserName($username)){
                $alert = 'Username Already Existed';
                return $alert;
            }
        }

        $sql = "insert into users (username, password, firstname, lastname, dateofbirth, email, country, gender) values (:username, :password, :firstname, :lastname, :dateofbirth, :email, :country, :gender)";
        // Prepare the statement
        $stmt = $connection->prepare($sql);
        // Bind parameters
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $hashPassword, PDO::PARAM_STR);
        $stmt->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $stmt->bindValue(':dateofbirth', $this->dateofbirth, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, 
        PDO::PARAM_STR);
        $stmt->bindValue(':country', $this->country, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $this->gender, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
}
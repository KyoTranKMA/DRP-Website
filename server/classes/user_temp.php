<?php
class User_Temp
{
    /*
        This class is manager 
            authenticate(): Login
            addUser(): Register
            access user is from 1 to 15 with 1 is biggest then down. 14 is ban, and 15 is delete user
                if add user, they has access with lever is 2, contribute is 1
    */
    private $username;
    private $password;
    private $dateofbirth;
    private $email;
    private $country;
    private $gender;
    protected $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    // Authenticate user (login)
    public static function authenticate($connection, $username, $password){
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

    public function addUser($username, $password, $dateofbirth, $email, $country, $gender){
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

        $sql = "insert into users (username, password, dateofbirth, email, country, gender, lever) values (:username, :password, :dateofbirth, :email, :country, :gender, :lever)";
        // Prepare the statement
        $stmt = $this->connection->prepare($sql);
        // Bind parameters
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $hashPassword, PDO::PARAM_STR);
        $stmt->bindValue(':dateofbirth', $this->dateofbirth, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':country', $this->country, PDO::PARAM_STR);
        $stmt->bindValue(':gender', $this->gender, PDO::PARAM_STR);
        $stmt->bindValue(':lever', 2, PDO::PARAM_INT);
        return $stmt->execute();
    }

    private function checkEmail($email){
        $sql = "select from users where email=:email LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) return true;
        return false;
    }

    private function checkUserName($username){
        $sql = "select from users where username=:username LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) return true;
        return false;
    }

    public function getID($username){
        $sql = "select ID from users where username=:username";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteUser($userID){
        $sql = "update users set lever = 15 where userID:=userID";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
    }
}

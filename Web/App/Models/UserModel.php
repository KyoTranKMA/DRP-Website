<?php namespace App\Models;
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
// use autoload from composer


class UserModel extends BaseModel
{
    const CLASSNAME = 'App\\Model\\UserModel';
    const TABLE = 'users';

    protected $id;
    protected $username;
    protected $password;
    protected $first_Name;
    protected $last_Name;
    protected $date_of_birth;
    protected $email;
    protected $gender;
    protected $level;

    // Support Function
    public function checkEmail($email)
    {
        return $this->check(self::TABLE, 'email', $email);
    }

    public function checkUserName($username)
    {
        return $this->check(self::TABLE, 'username', $username);
    }
    
    //Getter
    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getFirstName(){
        return $this->first_Name;
    }

    public function getLastName(){
        return $this->last_Name;
    }

    public function getDateOfBirth(){
        return $this->date_of_birth;
    }

    public function getLevel(){
        return $this->level;
    }


    // Main function
    public static function authenticate($data)
    {
        $models = new static;
        $sql = "SELECT * FROM users where username=:username";
        $stmt = $models->getConnect()->prepare($sql);
        $stmt->bindValue(':username', $data['username'], \PDO::PARAM_STR);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'App\Models\UserModel');
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            $passwordInDB = $result->password;
            // Check password input with password Hash
            if (password_verify($data['password'], $passwordInDB)) {
                // Return user to get id
                $data['id'] = $result->id;
                $_SESSION['level'] = $result->level;
                return $result;
            }
        }
        // Return false if the user is not found 
        return false;
    }

    public static function addUser($data)
    {
        $models = new static;
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, email, level) values (:username, :password, :email, :level)";
        // Prepare the statement
        $stmt = $models->getConnect()->prepare($sql);
        // Bind parameters
        $stmt->bindValue(':username', $data['username'], \PDO::PARAM_STR);
        $stmt->bindValue(':password', $data['password'], \PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], \PDO::PARAM_STR);
        $stmt->bindValue(':level', 3, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function getAllUser(){
        $models = new static;
        $sql = "SELECT * FROM users";
        $stmt = $models->getConnect()->prepare($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'App\Models\UserModel');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function setLevel($data){
        $models = new static;
        $sql = "UPDATE users SET level =:level WHERE id=:id";
        $stmt = $models->getConnect()->prepare($sql);
        $stmt->bindValue(':level', $data['level'], \PDO::PARAM_INT);
        $stmt->bindValue(':id', $data['id'], \PDO::PARAM_INT);
        $stmt->execute();
    }
}
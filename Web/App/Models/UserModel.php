<?php namespace App\Models;
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
// use autoload from composer


class UserModel extends BaseModel
{
    const CLASSNAME = get_called_class();
    const TABLE = 'users';

    private $id;
    private $username;
    private $password;
    private $email;
    private $first_Name;
    private $last_Name;
    private $date_of_birth;
    private $country;
    private $gender;
    private $level;

    private function checkEmail($email)
    {
        return $this->check(self::TABLE, 'email', $email);
    }

    private function checkUserName($username)
    {
        return $this->check(self::TABLE, 'username', $username);
    }
    
    public function authenticate($data)
    {
        $this->username = $data['username'];
        $this->password = $data['password'];


        $sql = "select * from users where username=:username";
        $stmt = $this->getConnect()->prepare($sql);
        $stmt->bindValue('::username', $this->username, \PDO::PARAM_STR);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::CLASSNAME);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) {
            $passwordInDB = $user->password;
            // Check password input with password Hash
            if (password_verify($this->password, $passwordInDB)) {
                // Return user to get id
                $_SESSION['level'] = $user->level;
                return $user;
            }
        }
        // Return false if the user is not found 
        return false;
    }

    public function addUser($data)
    {
        $this->username = $data['username'];
        $this->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->email = $data['email'];

        // check username and email has been
        if ($this->username == '' || $this->password == '' || $this->email == '') {
            $alert = 'Fields must be not empty!';
            return $alert;
        } else {
            if ($this->checkEmail($this->email)) {
                $alert = 'Email Already Existed';
                return $alert;
            };
            if ($this->checkUserName($this->username)) {
                $alert = 'Username Already Existed';
                return $alert;
            }
        }

        $sql = "insert into users (username, password, email, level) values (:username, :password, :email, :level)";
        // Prepare the statement
        $stmt = $this->getConnect()->prepare($sql);
        // Bind parameters
        $stmt->bindValue(':username', $this->username, \PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, \PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, \PDO::PARAM_STR);
        $stmt->bindValue(':level', 3, \PDO::PARAM_INT);
        return $stmt->execute();
    }

}

<?php
  class UserModel {
    public function __construct() {

    }

    public static function authenticate($connection, $data)
    {
      $email = $data['email'];
      $password = $data['password'];

      $sql = "SELECT * FROM users WHERE email=:email";
      $stmt = $connection->prepare($sql);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'UserModel');
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

    public function addUser($connection, $data){
      $username = $data['username'];
      $password = password_hash($data['password'], PASSWORD_DEFAULT);
      $dateofbirth = $data['dateofbirth'];
      $email = $data['email'];
      $country = $data['country'];
      $gender = $data['gender'];

      // check username and email has been
      if ($username == '' || $password == '' || $dateofbirth == '' || $email == '' || $country == '' || $gender == ''){
          $alert = 'Fields must be not empty!';
          return $alert;
      } else {
          if ($this->checkEmail($connection, $email)){
              $alert = 'Email Already Existed';
              return $alert;
          };
          if ($this->checkUserName($connection, $username)){
              $alert = 'Username Already Existed';
              return $alert;
          }
      }

      $sql = "insert into users (username, password, dateofbirth, email, country, gender, level) values (:username, :password, :dateofbirth, :email, :country, :gender, :level)";
      // Prepare the statement
      $stmt = $connection->prepare($sql);
      // Bind parameters
      $stmt->bindValue(':username', $username, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);
      $stmt->bindValue(':dateofbirth', $dateofbirth, PDO::PARAM_STR);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->bindValue(':country', $country, PDO::PARAM_STR);
      $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
      $stmt->bindValue(':level', 3, PDO::PARAM_INT);
      return $stmt->execute();
  }

  private function checkEmail($connection, $email){
    $sql = "select * from users where email=:email LIMIT 1";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'UserModel');
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user)
    {
        return true;
    } 
    return false;
  }

  private function checkUserName($connection, $username){
    $sql = "select * from users where username=:username LIMIT 1";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'UserModel');
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user) 
    {
      return true;
    }
    return false;
  }
}
?>
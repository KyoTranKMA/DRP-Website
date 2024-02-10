<?php 
class Admin extends User {
    public function deleteUser($connection, $userId) {
        $sql = "delete from users where id =:userId";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateUser($connection, $userId, $data) {
        $updateFields = '';
        foreach ($data as $key => $value) {
            $updateFields .= "$key = :$key, ";
        }
        $updateFields = rtrim($updateFields, ', ');

        $sql = "update users set $updateFields where id =:userId";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute();
    }
}

?>
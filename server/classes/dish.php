<?php

class Dish
{
    private $id;
    private $name;
    private $description;
    private $ingredient;
    private $nutrition;
    private $author;
    private $imagefile;


    public function __construct($name, $description, $ingredient, $nutrition, $author, $imagefile)
    {
        $this->name = $name;
        $this->description = $description;
        $this->ingredient = $ingredient;
        $this->nutrition = $nutrition;
        $this->author = $author;
        $this->imagefile = $imagefile;
    }
    private function validate()
    {
        return isset($this->name, $this->description, $this->ingredient, $this->nutrition, $this->author)
            && (empty($this->imagefile) || (file_exists($this->imagefile) && getimagesize($this->imagefile)));
    }

    public static function count($connection)
    {
        try {
            $sql = "select count(*) as total from dishs";
            // Prepare the statement
            $stmt = $connection->prepare($sql);

            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['total'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function add($connection)
    {
        if ($this->validate()) {
            try {
                $sql = "insert into dishs (nameDish, description, ingredient, nutrition , author, imagefile) values (:name, :description, :ingredient, :nutrition, :author, :imagefile)";
                // Prepare the statement
                $stmt = $connection->prepare($sql);

                // Bind parameters
                $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
                $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
                $stmt->bindValue(':ingredient', $this->ingredient, PDO::PARAM_STR);
                $stmt->bindValue(':nutrition', $this->nutrition, PDO::PARAM_STR);
                $stmt->bindValue(':author', $this->author, PDO::PARAM_STR);
                $stmt->bindValue(':imagefile', $this->imagefile, PDO::PARAM_STR);
                return $stmt->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        } else {
            $message = "Thông tin nhập vào không hợp lệ!";
            echo $message;
            exit;
        }
    }
    public static function getAll($connection)
    {
        try {

            $sql ="select * from dishs order by nameDish asc";
            // Prepare the statement
            $stmt = $connection->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Dish");
            if ($stmt->execute()) {
                $dishs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $dishs;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }


    public static function getByID($connection, $id)
    {
        try {
            $sql = "select * from dishs where id=:id";
            // Prepare the statement
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Dish");
            if ($stmt->execute()) {
                $Dish = $stmt->fetch();
                return $Dish;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }





    public function update($connection, $id)
    {
        try {
            $sql = "UPDATE dishs SET 
                    nameDish = :name, 
                    description = :description, 
                    ingredient = :ingredient, 
                    nutrition = :nutrition, 
                    author = :author, 
                    imagefile = :imagefile 
                    WHERE id = :id";

            // Prepare the statement
            $stmt = $connection->prepare($sql);

            // Bind parameters
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindValue(':ingredient', $this->ingredient, PDO::PARAM_STR);
            $stmt->bindValue(':nutrition', $this->nutrition, PDO::PARAM_STR);
            $stmt->bindValue(':author', $this->author, PDO::PARAM_STR);
            $stmt->bindValue(':imagefile', $this->imagefile, PDO::PARAM_STR);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Đã cập nhật món ăn id " . $id .  " thành công <br>";
                return true;
            } else {
                echo "Cập nhật món ăn id " . $id .  " thất bại <br>";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($connection)
    {
        try {
            $sql = "delete from dishs";
            // Prepare the statement
            $stmt = $connection->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Dish");
            if ($stmt->execute()) {
                echo "Đã xoá tất cả các món ăn thành công <br>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function deleteById($connection, $id)
    {
        try {
            $sql = "delete from dishs where id=:id";
            // Prepare the statement
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Dish");
            if ($stmt->execute()) {
                echo "Đã xoá món ăn id " . $id .  "thành công <br>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

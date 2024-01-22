<?php

class Dish
{
    private $id;
    private $name;
    private $description;
    private $ingredient;
    private $nutrition; //Lượng dinh dưỡng của món ăn
    private $author;
    private $imagefile;



    public function __construct($name, $description, $ingredient, $nutrition ,$author, $imagefile)
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
        if (!file_exists($this->imagefile)) {
            // Image file does not exist
            return $this->name != '' &&
                $this->description != '' &&
                $this->ingredient != '' &&
                $this->nutrition != '' &&
                $this->author != '';
        }
        else{
            // Image file exists
            return $this->name != '' &&
                $this->description != '' &&
                $this->ingredient != '' &&
                $this->nutrition != '' &&
                $this->author != '' &&
                $this->imagefile != '';
        }
    }

    public static function count(){

    }

    public function add($connection){
        if($this->validate()){
            try{
                $sql = "insert into dishs (name, description, ingredient, nutrition , author, imagefile) values (:name, :description, :ingredient, :nutrition, :author, :imagefile)";
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
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

    }
    public static function getAll($connection){
        try{
            $sql = "select * from dishs order by title asc";
            // Prepare the statement
            $stmt = $connection->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS,"Dish");
            if( $stmt->execute() ){
                $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return ($books);
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }

    }

    public function getByID($connection, $id){
        try{
            $sql = "select * from dishs where id=:id";
            // Prepare the statement
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS,"Dish");
            if( $stmt->execute() ){
                $Dish = $stmt->fetch();
                return $Dish;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }

    
    }
    public function update($connection){
        try{
            // Add them title author ... index
            $sql = "INSERT INTO `dishs`(`idDish`, `nameDish`, `description`, `ingredient`, `nutrition`, `author`, `imagefile`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
            $stmt = $connection->prepare($sql);
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function delete(){
    }
    public function deleteById($id){
        try{

            // Xoa theo id so may
            $sql = "delete * from books where id=:id";

        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
}

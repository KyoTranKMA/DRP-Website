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



    public function __construct($title, $description, $author, $imagefile)
    {
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->imagefile = $imagefile;
    }
    private function validate()
    {
        if (!file_exists($this->imagefile)) {
            return $this->title != '' &&
                $this->description != '' &&
                $this->author != '';
        }
    }

    public static function count(){

    }

    public function add($connection){
        if($this->validate()){
            try{
                $sql = "insert into books (title, description, author, imagefile) values (:title, :description, :author, :imagefile)";
                // Prepare the statement
                $stmt = $connection->prepare($sql);

                // Bind parameters
                $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
                $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
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
            $sql = "select * from books order by title asc";
            // Prepare the statement
            $stmt = $connection->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS,"Book");
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
            $sql = "select * from books where id=:id";
            // Prepare the statement
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS,"Book");
            if( $stmt->execute() ){
                $book = $stmt->fetch();
                return $book;
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
            $sql = "UPDATE `books` SET `id`='[value-1]',`title`='[value-2]',`description`='[value-3]',`author`='[value-4]',`imagefile`='[value-5]' WHERE id:=id";
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

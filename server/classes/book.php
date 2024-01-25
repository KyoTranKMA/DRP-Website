<?php

class Book
{
    private $id;
    private $title;
    private $description;
    private $author;
    private $imagefile;

    public function __construct($title, $description, $author, $imagefile)
    {
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->imagefile = $imagefile;
    }

    public static function count()
    {
    }

    public function add($connectionection)
    {

        $sql = "insert into books (title, description, author, imagefile) values (:title, :description, :author, :imagefile)";
        // Prepare the statement
        $stmt = $connectionection->prepare($sql);

        // Bind parameters
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':author', $this->author, PDO::PARAM_STR);
        $stmt->bindValue(':imagefile', $this->imagefile, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public static function getAll($connectionection)
    {
        try {
            $sql = "select * from books order by title asc";
            // Prepare the statement
            $stmt = $connectionection->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Book");
            if ($stmt->execute()) {
                $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return ($books);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function getByID($connectionection, $id)
    {
        try {
            $sql = "select * from books where id=:id";
            // Prepare the statement
            $stmt = $connectionection->prepare($sql);
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Book");
            if ($stmt->execute()) {
                $book = $stmt->fetch();
                return $book;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    public function update($connection ){
        try{
            $sql = "update books SET title=:title,description=:description,author=:author,imagefile=:imagefile * where id=:id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":id", $this->id, PDO::PARAM_STR);
            $stmt->bindValue(":title", $this->title, PDO::PARAM_STR);
            $stmt->bindValue(":description", $this->description, PDO::PARAM_STR);
            $stmt->bindValue(":author", $this->author, PDO::PARAM_STR);
            $stmt->bindValue(":imagefile", $this->imagefile, PDO::PARAM_STR);
            return $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function updateImage($connection, $id, $imagefile) {
        try{
            $sql = "update books set imagefile=:imagefile where id =:id;";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':imagefile', $imagefile, $imagefile == null ? PDO::PARAM_NULL : PDO::PARAM_INT);
            return $stmt->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }


    public static function getPaging($connection, $limit, $offset) {
        try{
            $sql = "select * from books order by title asc 
                    limit :limit
                    offset :offset";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':limit',$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset',$offset, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS,'Book');
            if($stmt->execute()) {
                $books = $stmt->fetchAll();
                return $books;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }

    public function delete()
    {
    }
    public function deleteById()
    {
        try {

            // Xoa theo id so may
            $sql = "delete * from books where id=:id";
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}

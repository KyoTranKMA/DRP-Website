<?
    class Adminstrators_Temp extends User_Temp
    {
        private $adminID;

        public function __construct($connection){
            parent::__construct($connection);
        }

        public function deletePost($postID){
            $sql = "delete from post where postID:=postID";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':postID', $postID, PDO::PARAM_INT);
            $stmt->execute();
        }

        public function ban($userID){
            $sql = "update users set lever = 14 where userID:=userID";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
        }

        public function postRank(){}

        public function setContribute($userID){
            $sql = "update users set lever = 1 where userID:=userID";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
        }
    };
?>
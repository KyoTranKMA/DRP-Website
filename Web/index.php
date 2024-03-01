<?php
  use App\Web;
  require_once("App/init.php");
  $web = new Web();

$servername = "db-mysql";
$username = "ad_db_ct07";
$password = "admin";
$dbname = "ct07_db";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

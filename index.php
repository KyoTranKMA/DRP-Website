<?php

// Include file the database connection

$conn = include(__DIR__ . "/include/db.php");

require_once(__DIR__ . "/classes/user.php");

if ($conn) {
    $username = 'quangdieu11';   
    $password = 'admin';

    $rs = User::authenticate($conn ,$username, $password);
    if ($rs) {
        echo "Login Success" . "\n";
    }
    else {
        echo "Authenticate error";
    }
}




echo "Test Query Data in DB ^^ <br>";

// Query to Users Table
$query = "SELECT `id`, `username`, `password` FROM `users` WHERE 1";
$result = $conn->query($query);

// Check if the query was successful
if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Fetch and display the results
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    echo "username: " . $row['username'] . ' - ' .  "password: " . $row['password'] . '<br>';
}



?>

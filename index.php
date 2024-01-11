<?php

// Include file establishes the database connection
$connection = include(__DIR__ . "/include/db.php");



echo "Test Query Data in DB ^^ <br>";

// Query to Users Table
$query = "SELECT `id`, `username`, `password` FROM `users` WHERE 1";
$result = $connection->query($query);

// Check if the query was successful
if ($result === false) {
    die("Query failed: " . $connection->error);
}

// Fetch and display the results
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    echo "username: " . $row['username'] . ' - ' .  "password: " . $row['password'] . '<br>';
}

// Close the connections with sever
$connection = null;


?>

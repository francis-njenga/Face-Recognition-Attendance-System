<?php

$host = "localhost";

//your database name
$database = "attendance-db";

//database user which by default is root unless you have configured with another name
$user = "root";

//password as empty string
$password = "";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    // Set PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

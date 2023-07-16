<?php 
$host = 'localhost';
$dbname = 'booking';
$username = 'root';
$password = '';

// Establish the PDO connection
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
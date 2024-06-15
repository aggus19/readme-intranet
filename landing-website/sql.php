<?php
$server = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$server;dbname=test", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

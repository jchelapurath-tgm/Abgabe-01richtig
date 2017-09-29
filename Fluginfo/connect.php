<?php

$servername = "localhost";
$username = $_POST['user'];
$password = $_POST['pw'];
$db = $_POST['db'];
$srv = $_POST['srv']; //Bsp Localhost
try {
   $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
   // set the PDO error mode to exception
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
catch(PDOException $e)
   {
   echo "Connection failed: " . $e->getMessage();
   }
  $conn = null;
?>

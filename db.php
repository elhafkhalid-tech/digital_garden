<?php
$host = "localhost";
$dbname = "digital_garden";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;",$username,$password);
} catch (PDOException $e) {
   die("erreur de connexion a la base de donne");
}
?>



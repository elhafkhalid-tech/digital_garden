<?php
session_start();
include 'db.php';
include 'auth.php';

$user = authGuard($conn); 

if(!isset($_GET['id'])) {
    header('Location: themes.php');
    exit;
}

$themeID = $_GET['id'];

$sql = "SELECT * FROM themes WHERE id = :id AND userID = :userID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $themeID);
$stmt->bindParam(':userID', $_SESSION['utilisateur_id']);
$stmt->execute();
$theme = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$theme){
    header('Location: themes.php');
    exit;
}

$sql = "DELETE FROM notes WHERE themeID = :themeID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':themeID', $themeID);
$stmt->execute();

$sql = "DELETE FROM themes WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $themeID);
$stmt->execute();

header('Location: themes.php');
exit;
?>

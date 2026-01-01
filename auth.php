<?php
function authGuard($conn)
{
    if (!isset($_SESSION['utilisateur_id'])) {
        header('location:login.php');
        exit;
    }
    $sql = 'SELECT nomUtilisateur,dateInscription FROM utilisateur where id = :id';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['utilisateur_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
?>

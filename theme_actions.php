<?php

if (isset($_POST['addTheme'])) {
    $nom = trim($_POST['nomTheme']);
    $couleur = $_POST['couleurTheme'];
    $sql = 'INSERT INTO themes (nom,couleur,userID) VALUES (:nom,:couleur,:userID)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':couleur', $couleur);
    $stmt->bindParam(':userID', $_SESSION['utilisateur_id']);

    if ($stmt->execute()) {
        header('location:themes.php');
        exit;
    }
}

if (isset($_POST['addNote'])) {
    $titre = trim($_POST['titreNote']);
    $contenu = trim($_POST['contenuNote']);
    $importance = $_POST['importanceNote'];
    $themeID = $_POST['themeID'];
    
    if ($titre !== '' && $contenu !== '') {
        $sql = "INSERT INTO notes (titre, importance, contenu, themeID, dateCreation)
                VALUES (:titre, :importance, :contenu, :themeID, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':importance', $importance);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':themeID', $themeID);
        $stmt->execute();
        header("Location: themes.php");
        exit;
    }
}

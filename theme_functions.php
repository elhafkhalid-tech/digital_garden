<?php
function getThemesByUser($conn, $userID)
{
    $sql = "SELECT * FROM themes WHERE userID = :userID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getNotesByTheme($conn, $themeID)
{
    $sql = "SELECT * FROM notes Where themeID=:themeID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':themeID',$themeID);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



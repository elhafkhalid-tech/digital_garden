<?php
session_start();
if (!isset($_SESSION['nomUtilisateur'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/output.css">
</head>

<body>
    <section class="min-h-screen flex  items-center justify-center p-8">
        <div class=" flex flex-col gap-9 bg-gray-200 p-5 rounded-lg w-full max-w-lg">
            <div>
                <h1 class="text-3xl font-bold text-green-700 mb-3">Bienvenue <?php echo $_SESSION['nomUtilisateur'] ?></h1>
                <p>Date d'inscription : <?php echo $_SESSION['dateInscription'] ?></p>
                <p>Heure de connexion : <?php echo $_SESSION['heureConnexion'] ?></p>
            </div>
            <div class="flex gap-4">
                <button class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Gérer mes Thèmes</button>
                <button class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Gérer mes Notes</button>
                <a href="index.php" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 text-center ">Déconnexion</a>
            </div>
        </div>
    </section>
</body>

</html>
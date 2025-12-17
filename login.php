<?php
session_start();
require 'db.php';
$errors = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
     
    $sql = "SELECT * FROM utilisateur 
    where email = '$email' 
    AND motDePasse = '$motDePasse'";
    
    $result = mysqli_query($connection, $sql);
    
    if (mysqli_num_rows($result) === 1) {

        $user = mysqli_fetch_assoc($result);
    
        $_SESSION['nomUtilisateur'] = $user['nomUtilisateur'];
        $_SESSION['dateInscription'] = $user['dateInscription'];
        $_SESSION['heureConnexion'] = date('H:i:s');

        header('location:dashboard.php');
        exit;
    } else {
        $errors = ' email or mot de passe incorrect';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/output.css">
</head>

<body>
    <section class=" min-h-screen flex flex-col items-center justify-center p-8 gap-6">
        <?php
        if(!empty($errors))
        {
            echo '<p class="text-red-600">'. $errors . '</p>';   
        }
        ?>
        <h1 class="text-center text-green-700 text-4xl font-bold tracking-wide">Connecter-vous</h1>
        <form method="POST" class=" bg-gray-200 p-5 rounded-lg w-full max-w-lg ">
            <div class="mb-5">
                <input type="email" name="email" placeholder="Email" class="w-full rounded p-3 border border-gray-600" required>
            </div>
            <div class="mb-5">
                <input type="password" name="motDePasse" placeholder="Mot de passe" class="w-full rounded p-3 border border-gray-600" required>
            </div>
            <div class="mb-5 flex  justify-evenly">
                <button type="submit" class=" bg-green-600 text-white py-2 px-4 rounded hover:bg-green-800 cursor-pointer">Se connecter</button>
                <a href="index.php" class=" bg-gray-600 text-white rounded py-2 px-4 hover:bg-blue-900 cursor-pointer">
                    Anuller
                </a>
            </div>
        </form>
    </section>
</body>

</html>
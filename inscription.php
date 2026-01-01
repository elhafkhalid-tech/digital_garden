
<?php
session_start();
require 'db.php';
$errors = [];
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomUtilisateur = $_POST['nomUtilisateur'];
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    $confirmationMDP = $_POST['confirmationMDP'];

    if ($nomUtilisateur === '' || strlen($nomUtilisateur) < 3) {
        $errors[] = "Nom utilisateur obligatoire (min 3 caractères)";
    }

    if ($motDePasse === '' || strlen($motDePasse) < 6) {
        $errors[] = "Mot de passe obligatoire (min 6 caractères)";
    }

    if ($motDePasse != $confirmationMDP) {
        $errors[] = 'Les mots de passe ne correspondent pas';
    }

    if ($email === '') {
        $errors[] = "email obligatoire";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO utilisateur (nomUtilisateur,motDePasse,email) 
                VALUES (:nomUtilisateur,:motDePasse,:email)";
        
        $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nomUtilisateur',$nomUtilisateur);
        $stmt->bindParam(':motDePasse',$hashedPassword);
        $stmt->bindParam(':email',$email);
        if ($stmt->execute()){
            $_SESSION['utilisateur_id'] = $conn->lastInsertId();
            header('Location: dashboard.php');
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Digital Garden</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" bg-green-100">
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="index.php" class="text-2xl font-bold text-green-600">
                🌱 Digital Garden 
            </a>
            <nav>
                <a href="index.php" class="text-gray-700 hover:text-green-600 font-medium transition">Accueil</a>      
            </nav>
        </div>
    </header>
    <section class=" min-h-screen flex items-center justify-center px-6">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6 flex flex-col justify-center">

            <h1 class="text-3xl sm:text-4xl font-extrabold text-green-600 text-center mb-5">Inscription</h1>
            
            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm sm:text-base">
                    <?php foreach ($errors as $error): ?>
                        <p><?=$error?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-3 text-left">

                <input type="text" name="nomUtilisateur" placeholder="Nom d'utilisateur" required
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400">

                <input type="email" name="email" placeholder="Email" required
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400">

                <input type="password" name="motDePasse" placeholder="Mot de passe" required
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400">

                <input type="password" name="confirmationMDP" placeholder="Confirmer le mot de passe" required
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400">

                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 sm:py-3 rounded-xl font-semibold hover:bg-green-700 transition shadow-md">
                    S'inscrire
                </button>

            </form>

            <p class="text-center mt-3 text-gray-600 text-sm sm:text-base">
                Déjà inscrit ? <a href="login.php" class="text-green-600 hover:underline">Se connecter</a>
            </p>

        </div>
    </section>
</body>

</html>

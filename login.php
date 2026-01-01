<?php
session_start();
include "db.php";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $motDePasse = $_POST['motDePasse'];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = 'Email non valide';
    if (empty($motDePasse))
        $errors[] = 'Mot de passe est obligatoire';
    
    if (empty($errors)) {
        $sql = 'SELECT * FROM utilisateur WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($motDePasse, $user['motDePasse'])) {
            $_SESSION['utilisateur_id'] = $user['id'];
            header('location:dashboard.php');
            exit;
        } else {
            $errors[] = "Compte n'existe pas";
        }
    }  
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Garden</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-green-50 to-gray-100 min-h-screen flex flex-col">
    <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="index.php" class="text-2xl font-bold text-green-600">
                Digital Garden 🌱
            </a>
            <nav class="hidden md:flex space-x-6">
                <a href="index.php" class="text-gray-700 hover:text-green-600 font-medium transition">Accueil</a>
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </div>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 space-y-3 bg-white">
            <a href="index.php" class="block text-gray-700 hover:text-green-600 font-medium transition">Accueil</a>
            <a href="inscription.php" class="block text-gray-700 hover:text-green-600 font-medium transition">S'inscrire</a>
            <a href="login.php" class="block text-gray-700 hover:text-green-600 font-medium transition">Se connecter</a>
        </div>
    </header>
    <section class="flex-grow flex items-center justify-center px-6">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl p-6 flex flex-col justify-center">

            <h1 class="text-3xl sm:text-4xl font-extrabold text-green-600 text-center mb-5">Connexion </h1>

            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm sm:text-base">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-3 text-left">

                <input type="email" name="email" placeholder="Email" required
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400">

                <input type="password" name="motDePasse" placeholder="Mot de passe" required
                    class="w-full p-2 sm:p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-400">

                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 sm:py-3 rounded-xl font-semibold hover:bg-green-700 transition shadow-md">
                    Se connecter
                </button>

            </form>

            <p class="text-center mt-3 text-gray-600 text-sm sm:text-base">
                Pas encore inscrit ? <a href="inscription.php" class="text-green-600 hover:underline">Créer un compte</a>
            </p>

        </div>
    </section>

    <script>
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

</body>

</html>

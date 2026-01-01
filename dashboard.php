<?php
session_start();
include 'db.php';
include 'auth.php';
$user = authGuard($conn);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Digital Garden</title>
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
                <a href="themes.php" class="text-gray-700 hover:text-green-600 font-medium transition">Mes Thèmes</a>
            </nav>
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
            <a href="themes.php" class="block text-gray-700 hover:text-green-600 font-medium transition">Mes Thèmes</a>
            <a href="logout.php" class="block text-gray-700 hover:text-red-600 font-medium transition">Déconnexion</a>
        </div>
    </header>
    <section class="flex-grow flex items-center justify-center px-6 py-10">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-8 flex flex-col gap-6">

            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-green-700 mb-3">
                    Bienvenue <?= htmlspecialchars($user['nomUtilisateur']) ?>
                </h1>
                <p>Date d'inscription : <?= htmlspecialchars($user['dateInscription']) ?></p>
                <p>Heure de connexion : <?= date('H:i:s') ?></p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="themes.php"
                    class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-xl text-center font-medium hover:bg-blue-700 transition">
                    Gérer mes Thèmes
                </a>
                <a href="logout.php"
                    class="flex-1 bg-red-600 text-white py-2 px-4 rounded-xl text-center font-medium hover:bg-red-700 transition">
                    Déconnexion
                </a>
            </div>

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

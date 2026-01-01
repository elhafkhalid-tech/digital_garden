<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Garden</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-100">
    <header class="bg-white shadow-md mx-auto px-6 py-4">
        <div>
            <a href="index.php" class="text-2xl font-bold text-green-600">
                🌱 Digital Garden
            </a>
        </div>
    </header>
    <section class="min-h-screen flex items-center justify-center px-6">
        <div class="max-w-3xl bg-white shadow-2xl rounded-2xl p-10 text-center">

            <h1 class="text-5xl font-extrabold text-green-600 mb-6">
                 Digital Garden 
            </h1>
            
            <p class="text-gray-600 text-lg  mb-10">
                Créez vos thèmes personnalisés pour organiser vos idées, ajoutez des notes liées à chaque thème
                et gérez votre jardin numérique en toute simplicité <br>   
                <span class="font-medium">Privé, clair et organisé.</span>
            </p>
            
            <div class="flex gap-6 justify-center">
                <a href="inscription.php">
                    <button
                        class="bg-green-600 text-white text-lg px-8 py-3 rounded-xl font-semibold hover:bg-green-700 ">
                        S'inscrire
                    </button>
                </a>
                
                <a href="login.php">
                    <button
                        class="bg-gray-700 text-white text-lg px-8 py-3 rounded-xl font-semibold hover:bg-gray-900">
                        Se connecter
                    </button>
                </a>
            </div>
        </div>
    </section>
</body>

</html>

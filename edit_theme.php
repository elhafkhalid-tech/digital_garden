<?php
session_start();
include 'db.php';
include 'auth.php';

$user = authGuard($conn);

if (!isset($_GET['id'])) {
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

if (!$theme) {
    header('Location: themes.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nomTheme']);
    $couleur = $_POST['couleurTheme'];

    if ($nom === '') {
        $errors[] = "Nom du thème obligatoire";
    }

    if (empty($errors)) {
        $sql = "UPDATE themes SET nom = :nom, couleur = :couleur WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':couleur', $couleur);
        $stmt->bindParam(':id', $themeID);
        $stmt->execute();

        header('Location: themes.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Theme</title>
    <link href="src/output.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-green-50 to-gray-100 min-h-screen flex items-center justify-center px-4">

    <section class="w-full max-w-md bg-white rounded-xl shadow-lg p-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-green-700">
                ✏️ Modifier le thème
            </h1>
            <a href="themes.php" class="text-sm text-gray-500 hover:text-gray-700">
                ✖
            </a>
        </div>

        <!-- Errors -->
        <?php if (!empty($errors)): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded mb-4 text-sm">
                <?php foreach ($errors as $error): ?>
                    <p>• <?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" class="space-y-5">

            <!-- Nom -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nom du thème
                </label>
                <input type="text"
                    name="nomTheme"
                    value="<?= htmlspecialchars($theme['nom']) ?>"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-green-300">
            </div>

            <!-- Couleur -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Couleur
                </label>
                <div class="flex items-center gap-4">
                    <input type="color"
                        name="couleurTheme"
                        value="<?= htmlspecialchars($theme['couleur']) ?>"
                        class="w-14 h-10 p-1 border border-gray-300 rounded">

                    <span class="text-sm text-gray-500">
                        Choisis une couleur douce 
                    </span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-6 pt-4">

                <a href="themes.php"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600
                      hover:bg-gray-100 transition">
                    Annuler
                </a>

                <button type="submit"
                    class=" p-3 rounded-lg bg-green-600 text-white
                           hover:bg-green-700 transition shadow">
                    Enregistrer
                </button>
            </div>

        </form>

    </section>

</body>

</html>
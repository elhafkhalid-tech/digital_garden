<?php
session_start();
include 'db.php';
include 'auth.php';
include 'theme_functions.php';
include 'theme_actions.php';

$user = authGuard($conn);
$themes = getThemesByUser($conn, $_SESSION['utilisateur_id']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Thèmes & Notes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-green-50 to-gray-100 min-h-screen">

    <!-- Navbar -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-green-600">Digital Garden 🌱</h1>
            <a href="logout.php" class="text-red-600 hover:underline">Déconnexion</a>
        </div>
    </header>

    <section class="max-w-6xl mx-auto px-6 py-8">

        <div class="flex gap-4 mb-6">
            <a href="dashboard.php"
                class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800">
                ← Dashboard
            </a>

            <button id="showAddTheme"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Ajouter un thème
            </button>
        </div>
        <!-- Form ajouter thème -->
        <div id="addThemeForm" class="hidden mb-6 bg-white p-4 rounded shadow">
            <form method="POST">
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Nom du thème</label>
                    <input type="text" name="nomTheme" required
                        class="w-full p-2 border rounded">
                </div>

                <div class="mb-3">
                    <label class="block mb-1 font-medium">Couleur</label>
                    <input type="color" name="couleurTheme" required
                        class="w-full h-10 border rounded">
                </div>
                    
                <button type="submit" name="addTheme"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Ajouter
                </button>
            </form>
        </div>
        <!-- Thèmes -->
        <div class="flex flex-wrap gap-6">
            <?php foreach ($themes as $theme): ?>
                <?php $notes = getNotesByTheme($conn, $theme['id']); ?>

                <div class="w-72 rounded shadow p-4 text-white"
                    style="background-color: <?= htmlspecialchars($theme['couleur']) ?>">

                    <h2 class="text-xl font-bold mb-3">
                        <?= htmlspecialchars($theme['nom']) ?>
                    </h2>

                    <!-- Notes -->

                    <?php if ($notes): ?>
                        <?php foreach ($notes as $note): ?>
                            <div class="bg-white text-black p-2 rounded mb-2">
                                <strong><?= htmlspecialchars($note['titre']) ?></strong>
                                <p class="text-sm"><?= htmlspecialchars($note['contenu']) ?></p>
                                <div class="flex items-center gap-1 mt-1">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $note['importance']) {
                                            echo '<span class="text-yellow-400 text-sm">★</span>';
                                        } else {
                                            echo '<span class="text-gray-300 text-sm">★</span>';
                                        }
                                    }
                                    ?>
                                </div>

                            </div>
                        <?php endforeach; ?>


                    <?php else: ?>
                        <p class="text-sm italic">Aucune note</p>
                    <?php endif; ?>

                    <!-- Bouton afficher formulaire note -->
                    <!-- Actions -->
                    <div class="flex items-center gap-2 mt-3">

                        <!-- Ajouter note -->
                        <button onclick="toggleNoteForm(<?= $theme['id'] ?>)"
                            class="bg-white text-green-700 border border-green-300 px-2 py-1 rounded text-sm
               hover:bg-green-50 transition">
                            + Note
                        </button>

                        <!-- Modifier thème -->
                        <a href="edit_theme.php?id=<?= $theme['id'] ?>"
                            class="bg-white text-blue-700 border border-blue-300 px-2 py-1 rounded text-sm
              hover:bg-blue-50 transition">
                            Modifier
                        </a>

                        <!-- Supprimer thème -->
                        <a href="delete_theme.php?id=<?= $theme['id'] ?>"
                            onclick="return confirm('Supprimer ce thème ?')"
                            class="bg-white text-red-600 border border-red-300 px-2 py-1 rounded text-sm
              hover:bg-red-50 transition">
                            Supprimer
                        </a>

                    </div>

                    <!-- Form ajouter note -->
                    <div id="noteForm-<?= $theme['id'] ?>"
                        class="hidden mt-3 bg-white text-black p-3 rounded shadow">

                        <form method="POST">
                            <input type="hidden" name="themeID" value="<?= $theme['id'] ?>">

                            <div class="mb-2">
                                <input type="text" name="titreNote" placeholder="Titre"
                                    required
                                    class="w-full p-2 border rounded focus:ring-2 focus:ring-green-300">
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium mb-1">Importance</label>

                                <div class="flex flex-row-reverse justify-end gap-1">

                                    <?php for ($i = 5; $i >= 1; $i--): ?>
                                        <input type="radio"
                                            id="star<?= $i ?>-<?= $theme['id'] ?>"
                                            name="importanceNote"
                                            value="<?= $i ?>"
                                            class="hidden peer"
                                            required>

                                        <label for="star<?= $i ?>-<?= $theme['id'] ?>"
                                            class="cursor-pointer text-gray-300 text-xl
                          peer-checked:text-yellow-400
                          hover:text-yellow-300 transition">
                                            ★
                                        </label>
                                    <?php endfor; ?>

                                </div>
                            </div>


                            <div class="mb-2">
                                <textarea name="contenuNote" placeholder="Contenu"
                                    required
                                    class="w-full p-2 border rounded focus:ring-2 focus:ring-green-300"></textarea>
                            </div>

                            <button type="submit" name="addNote"
                                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                Ajouter
                            </button>
                        </form>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </section>

    <script>
        document.getElementById('showAddTheme').addEventListener('click', () => {
            document.getElementById('addThemeForm').classList.toggle('hidden');
        });

        function toggleNoteForm(id) {
            document.getElementById('noteForm-' + id).classList.toggle('hidden');
        }
    </script>

</body>

</html>
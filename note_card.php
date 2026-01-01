    <div class="flex flex-col gap-2 mb-2">
        <?php foreach ($notes as $note): ?>
            <div class="p-2 bg-white text-black rounded">
                <strong><?= htmlspecialchars($note['titre']) ?></strong>
                <small> | <?= htmlspecialchars($note['contenu']) ?> | Importance: <?= $note['importance'] ?> | <?= $note['dateCreation'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="flex gap-2 mt-auto">
        <a href="" class="bg-blue-600 py-1 px-2 rounded hover:bg-blue-700">Modifier</a>
        <a href="delete_theme.php?id=<?= $theme['id'] ?>" class="bg-red-600 py-1 px-2 rounded hover:bg-red-700">Supprimer</a>
    </div>
    
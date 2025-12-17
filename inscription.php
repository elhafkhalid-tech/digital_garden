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
                VALUES ('$nomUtilisateur','$motDePasse','$email')";

        if (mysqli_query($connection, $sql)) {
            $_SESSION['nomUtilisateur'] = $nomUtilisateur;
            $_SESSION['dateInscription'] = date('Y-m-d');
            $_SESSION['heureConnexion'] = date('H:i:s');
            header('Location: dashboard.php');
            exit;
        }
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
        if (!empty($errors)) {
            echo '<p class="text-red-600">';
            foreach ($errors as $error) {
                echo $error . ' / ';
            }
            echo '</p>';
        }
        ?>

        <h1 class="text-center text-green-700 text-4xl font-bold tracking-wide">Inscrivez-vous</h1>

        <form id="formInscription" action="" method="POST" class=" bg-gray-200 p-5 rounded-lg w-full max-w-lg">
            <div class=" mb-3">
                <input type="text" id="nomUtilisateur" name="nomUtilisateur" placeholder="Nom utilisateur" class="w-full rounded p-3 border border-gray-600">
            </div>

            <div class=" mb-3">
                <input type="email" id="email" name="email" placeholder="Email" class="w-full rounded p-3 border border-gray-600">
            </div>

            <div class=" mb-3">
                <input type="password" id="motDePasse" name="motDePasse" placeholder="Mot de passe " class="w-full rounded p-3 border border-gray-600">
            </div>

            <div class=" mb-3">
                <input type="password" id="confirmationMDP" name="confirmationMDP" placeholder="Confirmation Mot de passe " class="w-full rounded p-3 border border-gray-600">
            </div>

            <div class=" mt-8 flex justify-evenly">
                <button type="submit" class=" w-60  bg-green-600 text-white p-3 rounded cursor-pointer hover:bg-green-700">
                    S'inscrire
                </button>
                <a href="index.php" class=" bg-gray-600 text-white rounded py-2 px-4 hover:bg-blue-900 cursor-pointer">
                    Anuller
                </a>
            </div>
        </form>
    </section>
    <!-- <script>
        function validationNomUtilisateur(valeurNom) {
            if (valeurNom === '' || valeurNom.length < 3) return false;
            return true;
        }

        function validationMotDePass(valeurMDP) {
            if (valeurMDP === '' || valeurMDP.length < 6) return false;
            return true;
        }

        const form = document.getElementById('formInscription');
        const nomUtilisateur = document.getElementById('nomUtilisateur');
        const motDePasse = document.getElementById('motDePasse');
        const confirmationMDP = document.getElementById('confirmationMDP');
        form.addEventListener('submit', e => {
            let hasError = false;

            const valeurNom = nomUtilisateur.value;
            const valeurMDP = motDePasse.value;
            const valeurConfirmationMDP = confirmationMDP.value;
            if (!validationNomUtilisateur(valeurNom) || !validationMotDePass(valeurMDP) || valeurMDP != valeurConfirmationMDP) {
                hasError = true;
            }
            if (hasError) {
                e.preventDefault();
            }
        })
    </script> -->
</body>

</html>
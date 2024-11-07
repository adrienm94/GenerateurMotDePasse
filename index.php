<?php

require_once "./vendor/autoload.php";

use \Adrie\Dev\PasswordGenerator;

$resGeneratePassword = "";
$resIsStrongPassword = "";

/* Logique avec conditionnelles, mais voir si on peut faire à la place un bloc try/catch*/

// Logique pour la longueur du mot de passe
if ($_POST && isset($_POST["length"])) {
    if ($_POST["length"] !== "" && $_POST["length"] !== "0") {
        $length = htmlspecialchars((int)$_POST['length']);
        $resGeneratePassword = $length < 4 ? "La longueur du mot de passe doit être d'au moins 4 caractères" : "Mot de passe généré :" . PasswordGenerator::generatePassword(htmlspecialchars($_POST["length"]));
    } else {
        $resGeneratePassword = "Veuillez saisir une longueur de mot de passe valide";
    }
}

// Logique pour la vérification du mot de passe
if ($_POST && isset($_POST["password-checked"])) {
    if ($_POST["password-checked"] !== "") {
        $isStrong = PasswordGenerator::isStrongPassword(htmlspecialchars($_POST["password-checked"]));
        $resIsStrongPassword = $isStrong ? "Le mot de passe est fort" : "Le mot de passe est faible";
    } else {
        $resIsStrongPassword = "Veuillez saisir un mot de passe valide";
    }
}

?>

<!DOCTYPE html>
<html lang="fr" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Générateur de mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="./main.js" defer></script>
</head>

<body class="vh-100 bg-light">
    <header class="container-fluid text-center px-0">
        <h1 class="h1 bg-primary text-white py-3">Générateur de mot de passe</h1>
    </header>
    <main class="container-fluid my-3">
        <section id="password-generation" class="container-fluid border mb-3 bg-white">
            <h2 class="h2">Formulaire de génération de mot de passe</h2>
            <form action="" method="post" id="password-generation-form" class="container-fluid">
                <label for="length" class="form-label">Longueur souhaitée du mot de passe</label>
                <input type="number" name="length" id="length" class="form-control" min="0">
                <button type="submit" id="length-button" class="btn btn-primary mt-1">Générer</button>
            </form>
            <p class="mt-1" id="length-message"><?php
            echo $resGeneratePassword;
            ?></p>
        </section>
        <section id="password-checking" class="container-fluid border mb-3 bg-white">
            <h2 class="h2">Formulaire de vérification de force de mot de passe</h2>
            <form action="./index.php" method="post" class="container-fluid">
                <label for="password-checked" class="form-label">Mot de passe :</label>
                <input type="password" name="password-checked" id="password-checked" class="form-control">
                <button type="submit" id="password-checking-button" class="btn btn-primary mt-1">Vérifier</button>
            </form>
            <p class="mt-1" id="password-checked-message"><?php
            echo $resIsStrongPassword;
            ?></p>
        </section>
    </main>
    <footer class="container-fluid mt-3 position-fixed bottom-0 bg-secondary">
        <p class="text-center text-white my-1">Adrien Meyrand - &copy; 2024</p>
    </footer>
</body>

</html>

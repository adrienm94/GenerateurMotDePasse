<?php

require_once "./vendor/autoload.php";

use \Adrie\Dev\PasswordGenerator;

$resGeneratePassword = "";
$resIsStrongPassword = "";
$checkBoxMessage = "";

/* Logique avec blocs try/catch */

// Logique pour la longueur du mot de passe et le choix des types de caractères
if ($_POST && isset($_POST["length"])) {
    try {
        $length = (int) htmlspecialchars($_POST['length']);
        $characterTypes = $_POST["characters"] ?? []; // équivaut à isset($_POST["characters"]) ? $_POST["characters"] : []
        $resGeneratePassword = "Mot de passe généré : " . PHP_EOL . PasswordGenerator::generatePassword($characterTypes, $length);
        $checkBoxMessage = "Voici le(s) type(s) de caractère(s) appliqué(s) sur le mot de passe généré : ";
        foreach ($characterTypes as $value) {
            $checkBoxMessage .= " | $value |";
        }
    } catch (\Throwable $th) {

        if ($th->getMessage() === "Au moins un type de caractère doit être sélectionné") {
            $checkBoxMessage = $th->getMessage();
        } else {
            $resGeneratePassword = $th->getMessage();
        }
        
    }
}

// Logique pour la vérification du mot de passe
if ($_POST && isset($_POST["password-checked"])) {
    try{
        $resIsStrongPassword = PasswordGenerator::isStrongPassword(htmlspecialchars($_POST["password-checked"]));
        if ($resIsStrongPassword === true) {
            $resIsStrongPassword = "Le mot de passe est fort";
        }
    } catch (\Throwable $th){
        $resIsStrongPassword = $th->getMessage();
    }
}



/* Autre façon de faire : logique avec seulement des conditionnelles*/
// Logique pour la longueur du mot de passe et le choix des types de caractères
// if ($_POST && isset($_POST["length"])) {
//     if ($_POST["length"] !== "" && $_POST["length"] !== "0") {
//         $length = htmlspecialchars((int) $_POST['length']);
//         // Logique pour la longueur du mot de passe
//         if (isset($_POST["characters"]) && count($_POST["characters"]) !== 0) {
//             $characterTypes = $_POST["characters"];
//             $checkBoxMessage = "Voici le(s) type(s) de caractère(s) appliqué(s) sur le mot de passe généré : ";
//             foreach ($characterTypes as $value) {
//                 $checkBoxMessage .= " | $value |";
//             }
//             if ($length < 4) {
//                 $resGeneratePassword = "La longueur du mot de passe doit être d'au moins 4 caractères";
//             } else {
//                 $resGeneratePassword = "Mot de passe généré : " . PHP_EOL . PasswordGenerator::generatePassword($characterTypes, htmlspecialchars($_POST["length"]));
//             }
//         } else {
//             $checkBoxMessage = "Au moins un type de caractère doit être sélectionné";
//         }

//     } else {
//         $resGeneratePassword = "Veuillez saisir une longueur de mot de passe valide";
//     }
// }



// // Logique pour la vérification du mot de passe
// if ($_POST && isset($_POST["password-checked"])) {
//     if ($_POST["password-checked"] !== "") {
//         $isStrong = PasswordGenerator::isStrongPassword(htmlspecialchars($_POST["password-checked"]));
//         $resIsStrongPassword = $isStrong ? "Le mot de passe est fort" : "Le mot de passe est faible";
//     } else {
//         $resIsStrongPassword = "Veuillez saisir un mot de passe valide";
//     }
// }

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

<body class="bg-light">
    <header class="container-fluid text-center position-sticky top-0 px-0">
        <h1 class="h1 bg-primary text-white py-3">Générateur de mot de passe</h1>
    </header>
    <main class="container-fluid my-3">
        <section id="password-generation" class="container-fluid border mb-3 bg-white">
            <h2 class="h2">Formulaire de génération de mot de passe</h2>
            <form action="" method="post" id="password-generation-form" class="container-fluid">
                <label for="length" class="form-label">Longueur souhaitée du mot de passe :</label>
                <input type="number" name="length" id="length" class="form-control" max="100">
                <p class="mt-1 overflow-auto" id="length-message"><?php echo $resGeneratePassword; ?></p>
                <p>Types de paramètres :</p>
                <div class="form-check">
                    <input type="checkbox" name="characters[]" value="upper" id="upper" class="form-check-input" checked>
                    <label for="upper" class="form-check-label">Majuscules</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="characters[]" value="lower" id="lower" class="form-check-input" checked>
                    <label for="lower" class="form-check-label">Minuscules</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="characters[]" value="numbers" id="numbers" class="form-check-input" checked>
                    <label for="numbers" class="form-check-label">Chiffres</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="characters[]" value="special" id="special" class="form-check-input" checked>
                    <label for="special" class="form-check-label">Caractères spéciaux</label>
                </div>
                <p class="mt-1" id="checkbox-message"><?php echo $checkBoxMessage; ?></p>
                <button type="submit" id="length-button" class="btn btn-primary my-1">Générer</button>
            </form>
        </section>
        <section id="password-checking" class="container-fluid border mb-3 bg-white">
            <h2 class="h2">Formulaire de vérification de force de mot de passe</h2>
            <form action="./index.php" method="post" class="container-fluid">
                <label for="password-checked" class="form-label">Mot de passe :</label>
                <input type="password" name="password-checked" id="password-checked" class="form-control">
                <p class="mt-1" id="password-checked-message"><?php echo $resIsStrongPassword;?></p>
                <button type="submit" id="password-checking-button" class="btn btn-primary my-1">Vérifier</button>
            </form>
        </section>
    </main>
    <footer class="container-fluid mt-3 bg-secondary position-fixed bottom-0">
        <p class="text-center text-white my-1">Adrien Meyrand - &copy; 2024</p>
    </footer>
</body>

</html>

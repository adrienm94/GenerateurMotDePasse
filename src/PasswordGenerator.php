<?php

namespace Adrie\Dev;

class PasswordGenerator
{
    // Déclaration des propriétés statiques pour les différents types de caractères
    private static $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Lettres majuscules
    private static $lower = 'abcdefghijklmnopqrstuvwxyz'; // Lettres minuscules
    private static $numbers = '0123456789';               // Chiffres
    private static $special = '!@#$%^&*()';               // Caractères spéciaux

    /**
     * Génère un mot de passe aléatoire sécurisé.
     *
     * @param int $length La longueur souhaitée du mot de passe (par défaut 12).
     * @return string Le mot de passe généré.
     * @throws \InvalidArgumentException Si la longueur est inférieure à 4.
     */
    final public static function generatePassword(array $characterTypes, int $length = 12): string
    {

        // Si la longueur est nulle ou négative
        if ($length <= 0){
            throw new \InvalidArgumentException("Veuillez saisir une longueur de mot de passe valide");
        }
        // Si la longueur est inférieure à 4
        if ($length < 4) {
            throw new \InvalidArgumentException("La longueur du mot de passe doit être d'au moins 4 caractères");
        }
        // Si le tableau $cahracterTypes est vide (aucun type coché)
        if (empty($characterTypes)) {
            throw new \InvalidArgumentException("Au moins un type de caractère doit être sélectionné");
        }

        // Concatène tous les ensembles de caractères trouvés dans $characters en une seule chaîne pour les tirages aléatoires
        // + On s'assure que le mot de passe contient au moins un caractère de chaque type
        $allCharacters = "";
        foreach ($characterTypes as $value) {
            if ($value === "upper") {
                $allCharacters .= self::$upper;
                $password[] = self::$upper[random_int(0, strlen(self::$upper) - 1)];
            } elseif ($value === "lower") {
                $allCharacters .= self::$lower;
                $password[] = self::$lower[random_int(0, strlen(self::$lower) - 1)];
            } elseif ($value === "numbers") {
                $allCharacters .= self::$numbers;
                $password[] = self::$numbers[random_int(0, strlen(self::$numbers) - 1)];
            } elseif ($value === "special") {
                $allCharacters .= self::$special;
                $password[] = self::$special[random_int(0, strlen(self::$special) - 1)];
            }
        }

        // Complète le mot de passe avec des caractères aléatoires jusqu'à atteindre la longueur souhaitée
        $characterTypesLength = count($characterTypes);
        for ($i = $characterTypesLength; $i < $length; $i++) {
            // Prend un caractère aléatoire parmi tous les caractères disponibles
            $password[] = $allCharacters[random_int(0, strlen($allCharacters) - 1)];
        }

        // Mélange l'ordre des caractères dans le mot de passe pour plus de sécurité
        shuffle($password);

        // Convertit le tableau en une chaîne de caractères et retourne le mot de passe généré
        return implode('', $password);
    }

    /**
     * Vérifie si un mot de passe est considéré comme "fort".
     *
     * @param string $password Le mot de passe à vérifier.
     * @return bool true si le mot de passe est fort, sinon false.
     */
    public static function isStrongPassword(string $password):bool
    {

        // Si le mot de passe est vide
        if ($password === "") {
            throw new \InvalidArgumentException("Veuillez saisir un mot de passe valide");
        }

        /* Le mot de passe doit avoir au moins 8 caractères, contenir au moins une majuscule, contenir au moins une minuscule,
        contenir au moins un chiffre et contenir au moins un caractères spécial */
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[\d]/', $password) || !preg_match('/[!@#$%^&*()]/', $password)){
            throw new \InvalidArgumentException("Le mot de passe est faible");
        }

        // Retourne true seulement si le mot de passe contient chaque type de caractère
        return true;
    }
}

//dd(PasswordGenerator::generatePassword());  // dump and die (j'affiche mes variables et je termine le script)

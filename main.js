// Définition de styles en fonction des messages affichés après soumission des formulaires

let lengthMessageParagraph = document.getElementById("length-message");
let checkBoxMessageParagraph = document.getElementById("checkbox-message");
let passwordCheckedMessageParagraph = document.getElementById("password-checked-message");

let lengthMessage = lengthMessageParagraph.textContent;
let checkBoxMessage = checkBoxMessageParagraph.textContent;
let passwordCheckedMessage = passwordCheckedMessageParagraph.textContent;

if (lengthMessage === "Veuillez saisir une longueur de mot de passe valide") {
    lengthMessageParagraph.style.color = "red";
} else if (lengthMessage === "La longueur du mot de passe doit être d'au moins 4 caractères") {
    lengthMessageParagraph.style.color = "orange";
} else {
    lengthMessageParagraph.style.color = "green";
}

if (checkBoxMessage === "Au moins un type de caractère doit être sélectionné") {
    checkBoxMessageParagraph.style.color = "red";
} else {
    checkBoxMessageParagraph.style.color = "green";
}

if (passwordCheckedMessage === "Veuillez saisir un mot de passe valide") {
    passwordCheckedMessageParagraph.style.color = "red";
} else if (passwordCheckedMessage === "Le mot de passe est faible") {
    passwordCheckedMessageParagraph.style.color = "orange";
} else {
    passwordCheckedMessageParagraph.style.color = "green";
}

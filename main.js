// Définition de styles en fonction du message affiché en dessous de chaque formulaire après soumission

let lengthMessageParagraph = document.getElementById("length-message");
let passwordCheckedMessageParagraph = document.getElementById("password-checked-message");

let lengthMessage = lengthMessageParagraph.textContent;
let passwordCheckedMessage = passwordCheckedMessageParagraph.textContent;

if (lengthMessage === "Veuillez saisir une longueur de mot de passe valide") {
    lengthMessageParagraph.style.color = "red";
} else if (lengthMessage === "La longueur du mot de passe doit être d'au moins 4 caractères") {
    lengthMessageParagraph.style.color = "orange";
} else {
    lengthMessageParagraph.style.color = "green";
}

if (passwordCheckedMessage === "Veuillez saisir un mot de passe valide") {
    passwordCheckedMessageParagraph.style.color = "red";
} else if (passwordCheckedMessage === "Le mot de passe est faible") {
    passwordCheckedMessageParagraph.style.color = "orange";
} else {
    passwordCheckedMessageParagraph.style.color = "green";
}

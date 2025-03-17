// Récupération des champs du formulaire
const nomInput = document.getElementById("nom");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const matriculeInput = document.getElementById("matricule");
const telephoneInput = document.getElementById("telephone");
const photoInput = document.getElementById("photo");
const adresseInput = document.getElementById("adresse");
const btnSubmit = document.querySelector("button[type='submit']");

// Variables de validation
let isNomValid = false;
let isEmailValid = false;
let isPasswordValid = false;
let isMatriculeValid = false;
let isTelephoneValid = false;
let isPhotoValid = true;
let isAdresseValid = false;

// Désactive le bouton de soumission par defaut
btnSubmit.disabled = true;

// Affichage des messages d'erreur
function showError(input, message) {
    const errorElement = input.nextElementSibling;
    if (message) {
        errorElement.textContent = message;
        input.classList.add("is-invalid");
    } else {
        errorElement.textContent = "";
        input.classList.remove("is-invalid");
    }
}

//Vérification globale du formulaire
function checkFormValidity() {
    if (
        isNomValid &&
        isPhotoValid &&
        isEmailValid &&
        isPasswordValid &&
        isMatriculeValid &&
        isTelephoneValid &&
        isAdresseValid
    ) {
        btnSubmit.removeAttribute("disabled");
    }
}

// Validation du nom
nomInput.addEventListener("input", () => {
    const nom = nomInput.value.trim();
    const nomValidator = Validator.nameValidator("Le nom", 2, 50, nom);
    if (nomValidator) {
        showError(nomInput, nomValidator.message);
        isNomValid = false;
    } else {
        showError(nomInput, "");
        isNomValid = true;
    }
    checkFormValidity();
});


// Validation du champ photo à la selection
photoInput.addEventListener("change", () => {
    const file = photoInput.files[0];
    if (!file) {
        showError(photoInput, "La photo est obligatoire.");
        isPhotoValid = false;
    }
    else if (!file.type.startsWith("image/")) {
        showError(photoInput, "Le fichier doit être une image.");
        isPhotoValid = false;
    }
    else {
        showError(photoInput, "");
        isPhotoValid = true;
    }
    checkFormValidity();
});

// Validation de l'email
emailInput.addEventListener("input", () => {
    const email = emailInput.value.trim();
    const emailValidator = Validator.emailValidator("L'email", email);
    if (emailValidator) {
        showError(emailInput, emailValidator.message);
        isEmailValid = false;
    } else {
        showError(emailInput, "");
        isEmailValid = true;
    }
    checkFormValidity();
});

// Validation du mot de passe
passwordInput.addEventListener("input", () => {
    const password = passwordInput.value.trim();
    const passwordValidator = Validator.passwordValidator("Le mot de passe", password, 8);
    if (passwordValidator) {
        showError(passwordInput, passwordValidator.message);
        isPasswordValid = false;
    } else {
        showError(passwordInput, "");
        isPasswordValid = true;
    }
    checkFormValidity();
});

// Validation du matricule
matriculeInput.addEventListener("input", () => {
    const matricule = matriculeInput.value.trim();
    if (matricule.length < 4) {
        showError(matriculeInput, "Le matricule doit contenir au moins 4 caractères");
        isMatriculeValid = false;
    } else {
        showError(matriculeInput, "");
        isMatriculeValid = true;
    }
    checkFormValidity();
});

// Validation du téléphone
telephoneInput.addEventListener("input", () => {
    const telephone = telephoneInput.value.trim();
    const telephoneValidator = Validator.phoneValidator("Le téléphone", 8, 13, telephone);
    if (telephoneValidator) {
        showError(telephoneInput, telephoneValidator.message);
        isTelephoneValid = false;
    } else {
        showError(telephoneInput, "");
        isTelephoneValid = true;
    }
    checkFormValidity();
});

// Validation de l'adresse
adresseInput.addEventListener("input", () => {
    const adresse = adresseInput.value.trim();
    const adresseValidator = Validator.adresseValidator("L'adresse", 5, 100, adresse);
    if (adresseValidator) {
        showError(adresseInput, adresseValidator.message);
        isAdresseValid = false;
    } else {
        showError(adresseInput, "");
        isAdresseValid = true;
    }
    checkFormValidity();
});

document.getElementById("formAjoutEtudiant").addEventListener("reset", () => {
    isNomValid = false;
    isPhotoValid = true;
    isEmailValid = false;
    isPasswordValid = false;
    isMatriculeValid = false;
    isTelephoneValid = false;
    isAdresseValid = false;
    btnSubmit.disabled = true;

    // Nettoyer les messages d'erreur
    const inputs = [nomInput, emailInput, passwordInput,
        matriculeInput, telephoneInput, photoInput, adresseInput];
    inputs.forEach(input => showError(input, ""));
});


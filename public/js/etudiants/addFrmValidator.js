// Récupération des champs du formulaire
const nomInput = document.getElementById("nom");
const prenomInput = document.getElementById("prenom");
const photoInput = document.getElementById("photo");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const matriculeInput = document.getElementById("matricule");
const telephoneInput = document.getElementById("telephone");
const adresseInput = document.getElementById("adresse");
const btnSubmit = document.querySelector("#formAjoutEtudiant button[type='submit']");

// Variables de validation
let isNomValid = false;
let isPrenomValid = false;
let isPhotoValid = true; // Optional field
let isEmailValid = false;
let isPasswordValid = false;
let isMatriculeValid = false;
let isTelephoneValid = false;
let isAdresseValid = false;

// Désactive le bouton de soumission par defaut
//btnSubmit.disabled = true;

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

// Vérification globale du formulaire
function checkFormValidity() {
    btnSubmit.disabled = !(
        isNomValid && 
        isPrenomValid && 
        isPhotoValid && 
        isEmailValid && 
        isPasswordValid && 
        isMatriculeValid && 
        isTelephoneValid && 
        isAdresseValid
    );
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

// Validation du prénom
prenomInput.addEventListener("input", () => {
    const prenom = prenomInput.value.trim();
    const prenomValidator = Validator.nameValidator("Le prénom", 2, 50, prenom);
    if (prenomValidator) {
        showError(prenomInput, prenomValidator.message);
        isPrenomValid = false;
    } else {
        showError(prenomInput, "");
        isPrenomValid = true;
    }
    checkFormValidity();
});

// Validation de la photo
photoInput.addEventListener("change", () => {
    const file = photoInput.files[0];
    if (file && !file.type.startsWith("image/")) {
        showError(photoInput, "Le fichier doit être une image");
        isPhotoValid = false;
    } else {
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
    const telephoneValidator = Validator.phoneValidator("Le téléphone", 9, 12, telephone);
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

// Reset du formulaire
document.getElementById("formAjoutEtudiant").addEventListener("reset", () => {
    isNomValid = false;
    isPrenomValid = false;
    isPhotoValid = true;
    isEmailValid = false;
    isPasswordValid = false;
    isMatriculeValid = false;
    isTelephoneValid = false;
    isAdresseValid = false;
    btnSubmit.disabled = true;
    
    // Nettoyer les messages d'erreur
    const inputs = [nomInput, prenomInput, photoInput, emailInput, passwordInput, 
                   matriculeInput, telephoneInput, adresseInput];
    inputs.forEach(input => showError(input, ""));
});

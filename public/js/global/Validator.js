class Validator 
{
    // Permet de valider un mot de passe
    static  passwordValidator(controlName,value,lengthWord)
    {
        return !value.length
            ? {error: true,message : `Le champ ${controlName} est obligatoire`}
            : value.length < lengthWord
                ? {error: true,message : `Le champ ${controlName} doit contenir au moins ${lengthWord} caractères`}
                : ((value != "") && (value.startsWith(" ") || value.endsWith(" ")))
                    ? {error: true,message : `Le champ ${controlName} ne doit pas commencer ou finir par un espace`}
                    : "";
    }

    // Permet de valider un email
    static emailValidator(controlName, value) {   
        // Expression régulière améliorée pour la validation d'email
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
        if (!value.length) {
            return {
                error: true,
                message: `Le champ ${controlName} est obligatoire`
            };
        }
        
        if (!emailRegex.test(value)) {
            return {
                error: true,
                message: `L'${controlName} doit respecter le format exemple@gmail.com`
            };
        }
        
        return null;
    }

    // Permet de valider un numéro de téléphone
    static phoneValidator(controlName, minilength, maxilength, value) {   
        // Regex pour les numéros de téléphone (accepte les chiffres et le +)
        const phoneRegex = /^[0-9+]+$/;

        if (!value.length) {
            return {
                error: true,
                message: `Le champ ${controlName} est obligatoire`
            };
        }

        if (!phoneRegex.test(value)) {
            return {
                error: true,
                message: `Le champ ${controlName} doit contenir uniquement des chiffres ou +`
            };
        }

        if (value.length < minilength || value.length > maxilength) {
            return {
                error: true,
                message: `Le champ ${controlName} doit contenir entre ${minilength} et ${maxilength} caractères`
            };
        }

        return ""; // Validation réussie
    }

    // Permet de valider un nom composé de chaine caractéres
    static nameValidator(controlName, minilength, maxlength, value) {
        let pattern = '^^[a-zA-ZàâäéèêëîïôöùûüçÀÂÄÉÈÊËÎÏÔÖÙÛÜÇ ]+$';
        if (!value.length){
            return {error: true, message: `Le champ ${controlName} est obligatoire`};
        }

        if (!value.match(new RegExp(pattern))) {
            return {error: true, message: `Le champ ${controlName} doit contenir uniquement des lettres`};
        }

        if (value.length < minilength || value.length > maxlength) {
            return {error: true, message: `Le champ ${controlName} doit contenir entre ${minilength} et ${maxlength} caractères`};
        }

        if ( value != "" && value.startsWith(" ") || value.endsWith(" ")) {
            return {error: true, message: `Le champ ${controlName} ne doit pas commencer ou finir par un espace`};
        }
        return ""; // Validation réussie
    }

    // Permet de valider une adresse
    static adresseValidator(controlName, minilength, maxlength, value) 
    {
        const isContainsNumber = '^(?=.*[0-9])';
        const isContainsUpperCase = '^(?=.*[A-Z])';
        const isContainsLowerCase = '^(?=.*[a-z])';
        const isContainsSymbol = '^(?=.*[-,;.])';

        if (!value.length) {
            return {error: true, message: `Le champ ${controlName} est obligatoire`};
        }

        if (isContainsSymbol.test(value) && isContainsNumber.test(value) && isContainsUpperCase.test(value) && isContainsLowerCase.test(value)) {
            return {error: true, message: `Le champ ${controlName} doit contenir au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial`};
        }

        if (value.length < minilength || value.length > maxlength) {
            return {error: true, message: `Le champ ${controlName} doit contenir entre ${minilength} et ${maxlength} caractères`};
        }

        if ( value != "" && value.startsWith(" ") || value.endsWith(" ")) {
            return {error: true, message: `Le champ ${controlName} ne doit pas commencer ou finir par un espace`};
        }
        return ""; // Validation réussie
    }
}
    
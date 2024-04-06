




// Fonction pour valider l'adresse email
function isValidEmail(email) {
    // Expression régulière pour valider une adresse email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Fonction pour valider le numéro de téléphone
function isValidPhone(phone) {
    // Expression régulière pour valider un numéro de téléphone
    var phoneRegex = /^\d{10}$/;
    return phoneRegex.test(phone);
}






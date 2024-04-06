const { reload } = require("browser-sync");



function verifierChamps() {
    var champs = ['nom_utilisateur', 'postnom_utilisateur', 'prenom_utilisateur', 'sexe_utilisateur', 'email_utilisateur', 'mot_de_passe_utilisateur', 'provider_utilisateur', 'telephone_utilisateur', 'privilege_utilisateur'];
    for (var i = 0; i < champs.length; i++) {
        var valeur = $('#' + champs[i]).val();
        if (valeur.trim() === "") {
            alert("Le champ '" + champs[i] + "' ne peut pas être vide.");
            return false; // Arrête la vérification si un champ est vide
        }
    }
    return true; // Tous les champs sont remplis
}




function openCode() {  
    if (verifierChamps()) {
    
      var popup = document.getElementById('popup-sec');
      popup.style.display = "flex";
}
}

function closeBtn() {
var popup = document.getElementById('popup-sec');
  popup.style.display = "none";
}


window.onclick = function(event) {
  if (event.target == popup) {
    popup.style.display = "none";
  }
}

function btnAnnuler() {
var btnAnnuler = document.getElementById('btnAnnuler-sec');
  location.reload();
  
  popup.style.display = "none";
   return;
}

// Pour activer le bouton lorsque le switch est validé
function toggleButton_accepte_condition() {
    var toggleCheckbox = document.getElementById("toggleButton");
    var actionButton = document.getElementById("btnValider-sec");

    if (toggleCheckbox.checked) {
        actionButton.disabled = false;
    } else {
        actionButton.disabled = true;
    }
}

function toggleButton_proprietaire_compte() {
    var toggleCheckbox_2 = document.getElementById("toggleButton_2");
    var actionButton_2 = document.getElementById("btnEnregistrer");

    if (toggleCheckbox_2.checked) {
        actionButton_2.disabled = false;
    } else {
        actionButton_2.disabled = true;
    }
}




function verifierMotDePasse() {
    var motDePasse = document.getElementById("mot_de_passe_utilisateur").value;
    // Vérifier la longueur du mot de passe
    if (motDePasse.length < 8) {
        alert("le mot de passe doit avoir plus de 8 caractere");
        return false;
    }



    if (motDePasse.length < 8) {
        alert("le mot de passe doit avoir plus de 8 caractere");
        return false;
    }

    // Vérifier la présence d'au moins une lettre majuscule
    var majusculeRegex = /[A-Z]/;
    if (!majusculeRegex.test(motDePasse)) {
        alert("le mot de passe doit avoir une lettre majuscule");
        return false;
    }

    // Vérifier la présence d'au moins une lettre minuscule
    var minusculeRegex = /[a-z]/;
    if (!minusculeRegex.test(motDePasse)) {
        alert("le mot de passe doit avoir une lettre miniscule");
        return false;

    }

    // Vérifier la présence d'au moins un chiffre
    var chiffreRegex = /[0-9]/;
    if (!chiffreRegex.test(motDePasse)) {
        alert("le mot de passe doit avoir un chiffre");
        return false;
    }

    // Vérifier la présence d'au moins un caractère spécial parmi les caractères couramment utilisés
    var caractereSpecialRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    if (!caractereSpecialRegex.test(motDePasse)) {
        alert("le mot de passe doit avoir une caractere special");
        return false;
    }

    return true;
}








function envoyerFormulaireUtilisateur() {

if (verifierChamps()) {
   
            var nom_utilisateur = $('#nom_utilisateur').val();
            var postnom_utilisateur = $('#postnom_utilisateur').val();
            var prenom_utilisateur = $('#prenom_utilisateur').val();
            var sexe_utilisateur = $('#sexe_utilisateur').val();
  
            var email_utilisateur = $('#email_utilisateur').val();
            var mot_de_passe_utilisateur = $('#mot_de_passe_utilisateur').val();
            var provider_utilisateur = $('#provider_utilisateur').val();
            var telephone_utilisateur = $('#telephone_utilisateur').val();
            var privilege_utilisateur = $('#privilege_utilisateur').val();
           

            //var encrypted_nom = crypt.encrypt(nom);
           // var encrypted_postnom = crypt.encrypt(postnom);
           // var encrypted_prenom = crypt.encrypt(prenom);
           // var encrypted_sexe = crypt.encrypt(sexe);
           // var encrypted_datedenaissance = crypt.encrypt(datedenaissance);
           // var encrypted_email = crypt.encrypt(email);
           // var encrypted_provider = crypt.encrypt(provider);
           // var encrypted_telephone = crypt.encrypt(telephone);
           // var encrypted_avenue = crypt.encrypt(avenue);
           // var encrypted_numero = crypt.encrypt(numero);
           // var encrypted_quartier = crypt.encrypt(quartier);
           // var encrypted_commune = crypt.encrypt(commune);
           // var encrypted_ville = crypt.encrypt(ville);
           // var encrypted_province = crypt.encrypt(province);


          // var encrypted_nom_pay = crypt.encrypt(nom_pay);
          // var encrypted_prenom_pay = crypt.encrypt(prenom_pay);
          // var encrypted_email_pay = crypt.encrypt(email_pay);
          // var encrypted_phone_pay = crypt.encrypt(phone_pay);
          // var encrypted_provider_pay = crypt.encrypt(provider_pay);
           //var encrypted_compte_utilisation_pay = crypt.encrypt(compte_utilisation_pay);

            $.ajax({
                url: 'server/utilisateur_form.php',
                type: 'POST',
                data: {
                    nom_utilisateur: nom_utilisateur,
                    postnom_utilisateur: postnom_utilisateur,
                    prenom_utilisateur: prenom_utilisateur,
                    sexe_utilisateur: sexe_utilisateur,
                    //datedenaissance: datedenaissance,
                    email_utilisateur: email_utilisateur,
                    mot_de_passe_utilisateur: mot_de_passe_utilisateur,
                    provider_utilisateur: provider_utilisateur,
                    telephone_utilisateur: telephone_utilisateur,
                    privilege_utilisateur: privilege_utilisateur

                  //  numero: numero,
                  //  quartier: quartier,
                  //  commune: commune,
                  //  ville: ville,
                  // province: province,
                   // nom_pay: encrypted_nom_pay,
                   // prenom_pay: encrypted_prenom_pay,
                  //  email_pay: encrypted_email_pay,
                  //  phone_pay: encrypted_phone_pay,
                   // provider_pay:encrypted_provider_pay,
                   // compte_utilisation_pay: compte_utilisation_pay
                },
                success: function(data) {
                    $('#x_panel_refresh').html(data);
                    location.reload();    
                },
                error: function(xhr, status, error) {
                    log('Javascript---Erreur  produite lors de la requête AJAX: ' + error);
                    alert("Javascript---Une erreur s'est produite lors de la requête AJAX: " + error);
                }
            });
        }}
        


function exist_telephone_utilisateur() {
    // Récupérer la valeur saisie dans l'input avec l'ID 'telephone'
    var telephone_utilisateur = $('#telephone_utilisateur').val();
    $.ajax({
        url: 'server/check_existing_telephone_utilisateur.php',
        type: 'POST',
        data: {
            telephone_utilisateur: telephone_utilisateur
        },
    });

    fetch('server/check_existing_telephone_utilisateur.php')
    .then(response => {
        if (!response.ok) {
            
            throw new Error('Erreur de réseau');
        }
        return response.json();
    })

    .then(data => {
        var publicKey = data.message;
        alert(publicKey);
    })
    .catch(error => {
        // Gestion des erreurs
        log('Javascript---renvoie une erreur : ---' + error.message)
        alert('Javascript---Une erreur s\'est produite : ' + error.message);
        return;
    });
}


function exist_email_utilisateur() {
    // Récupérer la valeur saisie dans l'input avec l'ID 'telephone'
    var email_utilisateur = $('#email_utilisateur').val();
    var provider_utilisateur = $('#provider_utilisateur').val();
    $.ajax({
        url: 'server/check_existing_email_utilisateur.php',
        type: 'POST',
        data: {
            email_utilisateur: email_utilisateur,
            provider_utilisateur: provider_utilisateur
        },
    });

    fetch('server/check_existing_email_utilisateur.php')

    .then(response => {
        if (!response.ok) {
            log('Erreur de réseau');
            throw new Error('Erreur de réseau');
        }
        return response.json();
    })

    .then(data => {
        var publicKey = data.message;
        alert(publicKey);
        
    })
    .catch(error => {
        // Gestion des erreurs
        log('Javascript---Une erreur s\'est produite : ' + error.message);
        alert('Javascript---Une erreur s\'est produite : ' + error.message);
        return;
    });
}


function log(message) {
    // Récupérer la valeur saisie dans l'input avec l'ID 'telephone'
    var bug = message;
    $.ajax({
        url: 'server/journalisation.php',
        type: 'POST',
        data: {
            bug: bug,
        },
    });
}







function getLineNumber() {
    try {
        throw new Error();
    } catch (e) {
        // Obtenez la pile d'appels de l'erreur
        var stack = e.stack.split('\n');
        // Trouvez la ligne qui appelle getLineNumber()
        var lineNumber = stack[2];
        // Récupérez le numéro de ligne en extrayant le numéro de la chaîne
        lineNumber = lineNumber.match(/:(\d+):\d+/)[1];
        return lineNumber;
    }
}



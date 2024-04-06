const { reload } = require("browser-sync");



function verifierChamps() {
    var champs = ['nom', 'postnom', 'prenom', 'sexe', 'datedenaissance', 'email', 'provider', 'telephone', 'avenue', 'numero', 'quartier', 'commune', 'ville', 'province', 'nom_pay', 'prenom_pay', 'email_pay', 'phone_pay', 'provider_pay', 'compte_utilisation_pay'];
    for (var i = 0; i < champs.length; i++) {
        var valeur = $('#' + champs[i]).val();
        if (valeur.trim() === "") {
            alert("Le champ '" + champs[i] + "' ne peut pas être vide.");
            return false; // Arrête la vérification si un champ est vide
        }
    }
    return true; // Tous les champs sont remplis
}




function openPopup() {  
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




function envoyerFormulaire() {

if (verifierChamps()) {
    var crypt = new JSEncrypt();

    fetch('server/gen_key.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur de réseau');
            }
            return response.json();
        })
        .then(data => {
            var publicKey = data.public_key;
            log('Javascript---Une clé de chiffrement à été reçu coté client avec succès');
            alert(publicKey);

            crypt.setPublicKey(publicKey);

            var nom = $('#nom').val();
            var postnom = $('#postnom').val();
            var prenom = $('#prenom').val();
            var sexe = $('#sexe').val();
            var datedenaissance = $('#datedenaissance').val();
            var email = $('#email').val();
            var provider = $('#provider').val();
            var telephone = $('#telephone').val();
            var avenue = $('#avenue').val();
            var numero = $('#numero').val();
            var quartier = $('#quartier').val();
            var commune = $('#commune').val();
            var ville = $('#ville').val();
            var province = $('#province').val();
            var nom_pay = $('#nom_pay').val();
            var prenom_pay = $('#prenom_pay').val();
            var email_pay = $('#email_pay').val();
            var phone_pay = $('#phone_pay').val();
            var provider_pay = $('#provider_pay').val();
            var compte_utilisation_pay = $('#compte_utilisation_pay').val();

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


           var encrypted_nom_pay = crypt.encrypt(nom_pay);
           var encrypted_prenom_pay = crypt.encrypt(prenom_pay);
           var encrypted_email_pay = crypt.encrypt(email_pay);
           var encrypted_phone_pay = crypt.encrypt(phone_pay);
           var encrypted_provider_pay = crypt.encrypt(provider_pay);
           //var encrypted_compte_utilisation_pay = crypt.encrypt(compte_utilisation_pay);

            $.ajax({
                url: 'server/collaborateur_form.php',
                type: 'POST',
                data: {
                    nom: nom,
                    postnom: postnom,
                    prenom: prenom,
                    sexe: sexe,
                    datedenaissance: datedenaissance,
                    email: email,
                    provider: provider,
                    telephone: telephone,
                    avenue: avenue,
                    numero: numero,
                    quartier: quartier,
                    commune: commune,
                    ville: ville,
                    province: province,
                    nom_pay: encrypted_nom_pay,
                    prenom_pay: encrypted_prenom_pay,
                    email_pay: encrypted_email_pay,
                    phone_pay: encrypted_phone_pay,
                    provider_pay:encrypted_provider_pay,
                    compte_utilisation_pay: compte_utilisation_pay
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
        })
        .catch(error => {
            log('Javascript---Erreur lors de la récupération de la clé publique:', error);
            alert('Javascript---Erreur lors de la récupération de la clé publique:', error);
        });
}

}




function exist_telephone() {
    // Récupérer la valeur saisie dans l'input avec l'ID 'telephone'
    var telephone = $('#telephone').val();
    $.ajax({
        url: 'server/check_existing_telephone.php',
        type: 'POST',
        data: {
            telephone: telephone,
        },
    });

    fetch('server/check_existing_telephone.php')
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


function exist_email() {
    // Récupérer la valeur saisie dans l'input avec l'ID 'telephone'
    var email = $('#email').val();
    var provider = $('#provider').val();
    $.ajax({
        url: 'server/check_existing_email.php',
        type: 'POST',
        data: {
            email: email,
            provider: provider
        },
    });

    fetch('server/check_existing_email.php')

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

function exist_compte_utilisation() {
    // Récupérer la valeur saisie dans l'input avec l'ID 'telephone'
    var compte_utilisation_pay = $('#compte_utilisation_pay').val();
    $.ajax({
        url: 'server/check_existing_compte_utilisation.php',
        type: 'POST',
        data: {
            compte_utilisation: compte_utilisation_pay,
        },
    });

    fetch('server/check_existing_compte_utilisation.php')

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



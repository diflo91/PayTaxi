<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
require_once("connexion_utilisateur.php");

// Informations à vérifier
$email_utilisateur = $_POST["email_utilisateur"];
$provider_utilisateur = $_POST["provider_utilisateur"];
$email_res_utilisateur = $email_utilisateur . "@" . $provider_utilisateur;
$telephone_utilisateur = $_POST["telephone_utilisateur"];

try {
    // Vérification si l'email existe déjà
    $sql_check_email = "SELECT * FROM users_auth WHERE email_utilisateur = :email_utilisateur";
    $stmt_check_email = $conn_util->prepare($sql_check_email);
    $stmt_check_email->execute(array(':email_utilisateur' => $email_res_utilisateur));

    if ($stmt_check_email->rowCount() > 0) {
        $_SESSION['notification_db_connexion_erreur_2_utilisateur'] = "<div id='notification-container-erreur-2_utilisateur'>
            <div id='notification-message-erreur-2_utilisateur'>
                L'email existe déjà.
            </div>
        </div>";
        $_SESSION['log'] = "L'email existe déjà.";
        require_once("journalisation.php");
        $conn_util = null;
        exit;
    }

    // Vérification si le numéro de téléphone existe déjà
    $sql_check_telephone = "SELECT * FROM users_auth WHERE telephone_utilisateur = :telephone_utilisateur";
    $stmt_check_telephone = $conn_util->prepare($sql_check_telephone);
    $stmt_check_telephone->execute(array(':telephone_utilisateur' => $telephone_utilisateur));

    if ($stmt_check_telephone->rowCount() > 0) {
        $_SESSION['notification_db_connexion_erreur_2_utilisateur'] = "<div id='notification-container-erreur-2_utilisateur'>
            <div id='notification-message-erreur-2_utilisateur'>
                Le numéro de téléphone existe déjà.
            </div>
        </div>";
        $_SESSION['log'] = "Le numéro de téléphone existe déjà.";
        require_once("journalisation.php");
        $conn_util = null;
        exit;
    }
    
    // Vérifie si les données sont soumises via la méthode POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Vérifie si la connexion à la base de données est réussie
        $nom_utilisateur = isset($_POST["nom_utilisateur"]) && !empty($_POST["nom_utilisateur"]) ? $_POST["nom_utilisateur"] : "";
        $postnom_utilisateur = isset($_POST["postnom_utilisateur"]) && !empty($_POST["postnom_utilisateur"]) ? $_POST["postnom_utilisateur"] : "";
        $prenom_utilisateur = isset($_POST["prenom_utilisateur"]) && !empty($_POST["prenom_utilisateur"]) ? $_POST["prenom_utilisateur"] : "";
        $sexe_utilisateur = isset($_POST["sexe_utilisateur"]) && !empty($_POST["sexe_utilisateur"]) ? $_POST["sexe_utilisateur"] : "";
       
        $email_utilisateur = isset($_POST["email_utilisateur"]) && !empty($_POST["email_utilisateur"]) ? $_POST["email_utilisateur"] : "";
        $mot_de_passe_utilisateur = isset($_POST["mot_de_passe_utilisateur"]) && !empty($_POST["mot_de_passe_utilisateur"]) ? $_POST["mot_de_passe_utilisateur"] : "";
        $provider_utilisateur = isset($_POST["provider_utilisateur"]) && !empty($_POST["provider_utilisateur"]) ? $_POST["provider_utilisateur"] : "";
        $result_email_utilisateur = $email_utilisateur . '@' . $provider_utilisateur;
        $telephone_utilisateur = isset($_POST["telephone_utilisateur"]) && !empty($_POST["telephone_utilisateur"]) ? $_POST["telephone_utilisateur"] : "";
        $privilege_utilisateur = isset($_POST["privilege_utilisateur"]) && !empty($_POST["privilege_utilisateur"]) ? $_POST["privilege_utilisateur"] : "";






        if ($conn_util) {
            // Préparation de la requête SQL pour les données personnelles
            $sql = "INSERT INTO users_auth (nom_utilisateur, postnom_utilisateur, prenom_utilisateur, sexe_utilisateur, email_utilisateur, mot_de_passe_utilisateur, telephone_utilisateur, privilege_utilisateur) 
                    VALUES (:nom_utilisateur, :postnom_utilisateur, :prenom_utilisateur, :sexe_utilisateur, :result_email_utilisateur, :mot_de_passe_utilisateur, :telephone_utilisateur, :privilege_utilisateur)";

            $stmt = $conn_util->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(":nom_utilisateur", $nom_utilisateur);
            $stmt->bindParam(":postnom_utilisateur", $postnom_utilisateur);
            $stmt->bindParam(":prenom_utilisateur", $prenom_utilisateur);
            $stmt->bindParam(":sexe_utilisateur", $sexe_utilisateur);
            $stmt->bindParam(":result_email_utilisateur", $email_res_utilisateur);
            $stmt->bindParam(":mot_de_passe_utilisateur", $mot_de_passe_utilisateur);
            $stmt->bindParam(":telephone_utilisateur", $telephone_utilisateur);
            $stmt->bindParam(":privilege_utilisateur", $privilege_utilisateur);

            // Exécution de la requête préparée
            if ($stmt->execute()) {
                $_SESSION['notification_db_connexion_valider_utilisateur'] = "<div id='notification-container-valider_utilisateur'>
                    <div id='notification-message-valider_utilisateur'>
                        Données utilisateur enregistrées
                    </div>
                </div>";
                $_SESSION['log'] = "Enregistrement des données d'utilisateur effectué";
                require_once("journalisation.php");
            }
        }
    }
} catch (PDOException $e) {
    // En cas d'erreur lors de l'exécution de la requête SQL
    $_SESSION['notification_db_connexion_erreur_7_utilisateur'] = "<div id='notification-container-erreur-7_utilisateur'>
        <div id='notification-message-erreur-7_utilisateur'>
            Erreur, code : 0X005GD
        </div>
    </div>" . $e->getMessage();
    $_SESSION['log'] = "Erreur, code : 0X008V5---" . $e->getMessage();
    require_once("journalisation.php");

    $conn_util = null;
    exit;
}
?>

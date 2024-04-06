<?php
if(session_status() === PHP_SESSION_NONE) {
session_start();
}

$privateK = $_SESSION['private_key'];
// Clé privée RSA
$privateKey = <<<EOD
$privateK
EOD;
// Connexion à la base de données
require_once("connexion_user.php");
require_once("connexion_banque_info.php");
require_once("connexion_rsa.php");

























// Informations à vérifier
$email = $_POST["email"];
$provider = $_POST["provider"];

$email_res = $email."@".$provider;
$telephone = $_POST["telephone"];
$compte = $_POST["compte_utilisation_pay"];
$nom = $_POST["nom"];
$postnom = $_POST["postnom"];
$prenom = $_POST["prenom"];
$datedenaissance = $_POST["datedenaissance"];







try {
    // Vérification si l'email existe déjà
    $sql_check_email = "SELECT * FROM collaborateur_cdt WHERE email = :email";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->execute(array(':email' => $email_res));

    if ($stmt_check_email->rowCount() > 0) {
        $_SESSION['notification_db_connexion_erreur_2'] = "<div id='notification-container-erreur-2'>
            <div id='notification-message-erreur-2'>
                L'email existe déjà.
            </div>
        </div>";
        $_SESSION['log'] ="L'email existe déjà.";
        require_once("journalisation.php");
        $conn = null;
        $conn_pay = null;
        $conn_rsa = null;
        exit;
    }

    // Vérification si le numéro de téléphone existe déjà
    $sql_check_telephone = "SELECT * FROM collaborateur_cdt WHERE telephone = :telephone";
    $stmt_check_telephone = $conn->prepare($sql_check_telephone);
    $stmt_check_telephone->execute(array(':telephone' => $telephone));

    if ($stmt_check_telephone->rowCount() > 0) {
        $_SESSION['notification_db_connexion_erreur_2'] = "<div id='notification-container-erreur-2'>
            <div id='notification-message-erreur-2'>
                Le numéro de téléphone existe déjà.
            </div>
        </div>";
        $_SESSION['log'] ="Le numéro de téléphone existe déjà.";
        require_once("journalisation.php");
        $conn = null;
        $conn_pay = null;
        $conn_rsa = null;
        exit;
    }

    // Vérification si le compte existe déjà
    $sql_check_compte = "SELECT * FROM collaborateur_compte_util WHERE numero_compte_utilisation = :compte";
    $stmt_check_compte = $conn_pay->prepare($sql_check_compte);
    $stmt_check_compte->execute(array(':compte' => $compte));

    if ($stmt_check_compte->rowCount() > 0) {
        $_SESSION['notification_db_connexion_erreur_2'] = "<div id='notification-container-erreur-2'>
            <div id='notification-message-erreur-2'>
                Le compte existe déjà.
            </div>
        </div>";
        $_SESSION['log'] ="Le compte existe déjà.";
        require_once("journalisation.php");
        $conn = null;
        $conn_pay = null;
        $conn_rsa = null;
        exit;
    }

    // Requête SQL pour vérifier si la personne existe
    $sql_check_personne = "SELECT * FROM collaborateur_cdt WHERE nom = :nom AND postnom = :postnom AND prenom = :prenom AND datedenaissance = :datedenaissance";
    $stmt_check_personne = $conn->prepare($sql_check_personne);
    $stmt_check_personne->execute(array(
        ':nom' => $nom,
        ':postnom' => $postnom,
        ':prenom' => $prenom,
        ':datedenaissance' => $datedenaissance
    ));

    // Vérification si la personne existe
    if ($stmt_check_personne->rowCount() > 0) {
        $_SESSION['notification_db_connexion_erreur_2'] = "<div id='notification-container-erreur-2'>
        <div id='notification-message-erreur-2'>
            Cette personne existe déjà.
        </div>
    </div>";
    $_SESSION['log'] ="Cette personne existe déjà.";
    require_once("journalisation.php");
    $conn = null;
    $conn_pay = null;
    $conn_rsa = null;
    exit;
    } else {
        // Vérifie si les données sont soumises via la méthode POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Vérifie si les clés privée et publique sont présentes dans la session
            if (isset($_SESSION['private_key']) && isset($_SESSION['public_key'])) {

                // Récupération des clés privée et publique depuis la session
                $privateString = $_SESSION['private_key'];
                $publicString = $_SESSION['public_key'];

                // Création de l'identifiant unique du client
                $prefixe = "K-K-";
                $uniqueKey = bin2hex(random_bytes(8)); 
                $identifiant_client = $prefixe . $uniqueKey;

                // Récupération des données soumises via le formulaire POST
                $nom = isset($_POST["nom"]) && !empty($_POST["nom"]) ? $_POST["nom"] : "";
                $postnom = isset($_POST["postnom"]) && !empty($_POST["postnom"]) ? $_POST["postnom"] : "";
                $prenom = isset($_POST["prenom"]) && !empty($_POST["prenom"]) ? $_POST["prenom"] : "";
                $sexe = isset($_POST["sexe"]) && !empty($_POST["sexe"]) ? $_POST["sexe"] : "";
                $datedenaissance = isset($_POST["datedenaissance"]) && !empty($_POST["datedenaissance"]) ? $_POST["datedenaissance"] : "";
                $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"] : "";
                $provider = isset($_POST["provider"]) && !empty($_POST["provider"]) ? $_POST["provider"] : "";
                $result_email = $email . '@' . $provider;
                $telephone = isset($_POST["telephone"]) && !empty($_POST["telephone"]) ? $_POST["telephone"] : "";
                $avenue_adresse = isset($_POST["avenue"]) && !empty($_POST["avenue"]) ? $_POST["avenue"] : "";
                $numero_adresse = isset($_POST["numero"]) && !empty($_POST["numero"]) ? $_POST["numero"] : "";
                $quartier_adresse = isset($_POST["quartier"]) && !empty($_POST["quartier"]) ? $_POST["quartier"] : "";
                $commune_adresse = isset($_POST["commune"]) && !empty($_POST["commune"]) ? $_POST["commune"] : "";
                $ville_adresse = isset($_POST["ville"]) && !empty($_POST["ville"]) ? $_POST["ville"] : "";
                $province_adresse = isset($_POST["province"]) && !empty($_POST["province"]) ? $_POST["province"] : "";

                $nom_pay = isset($_POST["nom_pay"]) && !empty($_POST["nom_pay"]) ? $_POST["nom_pay"] : "";
                $prenom_pay = isset($_POST["prenom_pay"]) && !empty($_POST["prenom_pay"]) ? $_POST["prenom_pay"] : "";
                $email_pay = isset($_POST["email_pay"]) && !empty($_POST["email_pay"]) ? $_POST["email_pay"] : "";
                $phone_pay = isset($_POST["phone_pay"]) && !empty($_POST["phone_pay"]) ? $_POST["phone_pay"] : "";
                $provider_pay = isset($_POST["provider_pay"]) && !empty($_POST["provider_pay"]) ? $_POST["provider_pay"] : "";
                $compte_utilisation_pay = isset($_POST["compte_utilisation_pay"]) && !empty($_POST["compte_utilisation_pay"]) ? $_POST["compte_utilisation_pay"] : "";

            

                // Vérifie si la connexion à la base de données est réussie
                if ($conn) {
                    // Préparation de la requête SQL pour les données personnelles
                    $sql = "INSERT INTO collaborateur_cdt (identifiant_client, nom, postnom, prenom, sexe, datedenaissance, email, telephone, avenue_adresse, numero_adresse, quartier_adresse, commune_adresse, ville_adresse, province_adresse) 
                            VALUES (:identifiant_client, :nom, :postnom, :prenom, :sexe, :datedenaissance, :email, :telephone, :avenue_adresse, :numero_adresse, :quartier_adresse, :commune_adresse, :ville_adresse, :province_adresse)";

                    $stmt = $conn->prepare($sql);

                    // Liaison des paramètres
                    $stmt->bindParam(":identifiant_client", $identifiant_client);
                    $stmt->bindParam(":nom", $nom);
                    $stmt->bindParam(":postnom", $postnom);
                    $stmt->bindParam(":prenom", $prenom);
                    $stmt->bindParam(":sexe", $sexe);
                    $stmt->bindParam(":datedenaissance", $datedenaissance);
                    $stmt->bindParam(":email", $result_email);
                    $stmt->bindParam(":telephone", $telephone);
                    $stmt->bindParam(":avenue_adresse", $avenue_adresse);
                    $stmt->bindParam(":numero_adresse", $numero_adresse);
                    $stmt->bindParam(":quartier_adresse", $quartier_adresse);
                    $stmt->bindParam(":commune_adresse", $commune_adresse);
                    $stmt->bindParam(":ville_adresse", $ville_adresse);
                    $stmt->bindParam(":province_adresse", $province_adresse);

                    // Exécution de la requête préparée
                    if ($stmt->execute()) {
                        $_SESSION['notification_db_connexion_valider'] = "<div id='notification-container-valider'>
                                                            <div id='notification-message-valider'>
                                                                Données personnelles enregistrées
                                                            </div>
                                                        </div>";
                                                        $_SESSION['log'] ="Enregistrement des données personnelles effectué";
                                                        require_once("journalisation.php");

                        // Vérifie si les informations bancaires sont présentes
                        if (isset($_POST["nom_pay"]) && isset($_POST["prenom_pay"]) && isset($_POST["email_pay"]) && isset($_POST["phone_pay"]) && isset($_POST["provider_pay"]) && isset($_POST["compte_utilisation_pay"])) {

                            // Connexion à la base de données des informations bancaires
                            if ($conn_pay) {
                                // Préparation de la requête SQL pour les données bancaires
                                $sql_pay = "INSERT INTO collaborateur_compte_util (identifiant_client, nom_post_collab, prenom_collab, email_collab, telephone_collab, provider_pay, numero_compte_utilisation) 
                                            VALUES (:identifiant_client_pay, :nom_pay, :prenom_pay, :email_pay, :phone_pay, :provider_pay, :compte_utilisation_pay)";

                                $stmt_pay = $conn_pay->prepare($sql_pay);

                                // Liaison des paramètres
                                $stmt_pay->bindParam(":identifiant_client_pay", $identifiant_client);
                                $stmt_pay->bindParam(":nom_pay", $nom_pay);
                                $stmt_pay->bindParam(":prenom_pay", $prenom_pay);
                                $stmt_pay->bindParam(":email_pay", $email_pay);
                                $stmt_pay->bindParam(":phone_pay", $phone_pay);
                                $stmt_pay->bindParam(":provider_pay", $provider_pay);
                                $stmt_pay->bindParam(":compte_utilisation_pay", $compte_utilisation_pay);

                                // Exécution de la requête préparée
                                if ($stmt_pay->execute()) {
                                    $_SESSION['notification_db_connexion_valider_2'] = "<div id='notification-container-valider-2'>
                                                                            <div id='notification-message-valider-2'>
                                                                                Données bancaires enregistrées
                                                                            </div>
                                                                        </div>";
                                                                        $_SESSION['log'] ="Données bancaires enregistrées.";
                                                                        require_once("journalisation.php");

                                    // Insertion des clés RSA dans la table k_rsa
                                    $sql_rsa = "INSERT INTO k_rsa (identifiant_client, pvt_rsa, puc_rsa) VALUES (:identifiant_client_pay, :private_key, :public_key)";
                                    $stmt_rsa = $conn_rsa->prepare($sql_rsa);

                                    // Liaison des paramètres
                                    $stmt_rsa->bindParam(":identifiant_client_pay", $identifiant_client);
                                    $stmt_rsa->bindParam(':private_key', $privateString);
                                    $stmt_rsa->bindParam(':public_key', $publicString);

                                    // Exécution de la requête
                                    if ($stmt_rsa->execute()) {
                                        $_SESSION['notification_db_connexion_valider_3'] = "<div id='notification-container-valider-3'>
                                                                            <div id='notification-message-valider-3'>
                                                                                Cryptage effectué
                                                                            </div>
                                                                        </div>";
                                                                        $_SESSION['log'] ="Cryptage effectué.";
                                                                        require_once("journalisation.php");
                                    } else {
                                        $_SESSION['notification_db_connexion_valider_5'] = "<div id='notification-container-valider-5'>
                                                                            <div id='notification-message-valider-5'>
                                                                                Cryptage échoué
                                                                            </div>
                                                                        </div>";
                                                                        $_SESSION['log'] ="Cryptage échoué.";
                                                                        require_once("journalisation.php");

                                                                        $conn = null;
                                                                        $conn_pay = null;
                                                                        $conn_rsa = null;
                                                                        exit;
                                                                        
                                    }
                                    
                                } else {
                                    $_SESSION['notification_db_connexion_erreur_1'] = "<div id='notification-container-erreur-1'>
                                                                            <div id='notification-message-erreur-1'>
                                                                                Erreur d'enregistrement des données bancaires, code : 0X002EI
                                                                            </div>
                                                                        </div>";
                                                                        $_SESSION['log'] ="Erreur d'enregistrement des données bancaires, code : 0X002EI.";
                                                                        require_once("journalisation.php");

                                                                        $conn = null;
                                                                        $conn_pay = null;
                                                                        $conn_rsa = null;
                                                                        exit;
                                }
                            } else {
                                $_SESSION['notification_db_connexion_erreur_2'] = "<div id='notification-container-erreur-2'>
                                                                    <div id='notification-message-erreur-2'>
                                                                        Connexion à la base de données des informations bancaires échouée, code : 0X002BI
                                                                    </div>
                                                                </div>";
                                                                $_SESSION['log'] ="Connexion à la base de données des informations bancaires échouée, code : 0X002BI.";
                                                                require_once("journalisation.php");

                                                                $conn = null;
                                                                $conn_pay = null;
                                                                $conn_rsa = null;
                                                                exit;
                            }
                        } else {
                            $_SESSION['notification_db_connexion_erreur_3'] = "<div id='notification-container-erreur-3'>
                                                                    <div id='notification-message-erreur-3'>
                                                                        Certains champs pour les données bancaires manquent, code : 0X002MI
                                                                    </div>
                                                                </div>";
                                                                $_SESSION['log'] ="Certains champs pour les données bancaires manquent, code : 0X002MI.";
                                                                require_once("journalisation.php");

                                                                $conn = null;
                                                                $conn_pay = null;
                                                                $conn_rsa = null;
                                                                exit;
                        }
                    } else {
                        $_SESSION['notification_db_connexion_erreur_4'] = "<div id='notification-container-erreur-4'>
                                                            <div id='notification-message-erreur-4'>
                                                                Erreur d'enregistrement des données personnelles, code : 0X002DI
                                                            </div>
                                                        </div>";
                                                        $_SESSION['log'] ="Erreur d'enregistrement des données personnelles, code : 0X002DI.";
                                                        require_once("journalisation.php");

                                                        $conn = null;
                                                        $conn_pay = null;
                                                        $conn_rsa = null;
                                                        exit;
                    }
                    // Fermeture du statement et de la connexion
                    $conn = null;
                } else {
                    $_SESSION['notification_db_connexion_erreur_5'] = "<div id='notification-container-erreur-5'>
                                                        <div id='notification-message-erreur-5'>
                                                            Connexion à la base de données échouée, code : 0X002AI
                                                        </div>
                                                    </div>";
                                                    $_SESSION['log'] ="Connexion à la base de données échouée, code : 0X002AI.";
                                                    require_once("journalisation.php");

                                                    $conn = null;
                                                    $conn_pay = null;
                                                    $conn_rsa = null;
                                                    exit;
                }
            } else {
                $_SESSION['notification_db_connexion_erreur_6'] = "<div id='notification-container-erreur-6'>
                                                    <div id='notification-message-erreur-6'>
                                                        Clés privée et/ou publique manquante(s) dans la session, code : 0X008KF
                                                    </div>
                                                </div>";
                                                $_SESSION['log'] ="Clés privée et/ou publique manquante(s) dans la session, code : 0X008KF.";
                                                require_once("journalisation.php");

                                                $conn = null;
                                                $conn_pay = null;
                                                $conn_rsa = null;
                                                exit;
            }
        } else {
            $_SESSION['notification_db_connexion_erreur_7'] = "<div id='notification-container-erreur-7'>
                                            <div id='notification-message-erreur-7'>
                                                Aucune donnée envoyée via la méthode POST, code : 0X008PD
                                            </div>
                                        </div>";
                                        $_SESSION['log'] ="Aucune donnée envoyée via la méthode POST, code : 0X008PD.";
                                        require_once("journalisation.php");

                                        $conn = null;
                                        $conn_pay = null;
                                        $conn_rsa = null;
                                        exit;
        }
    }
} catch (PDOException $e) {
    // En cas d'erreur lors de l'exécution de la requête SQL
    $_SESSION['notification_db_connexion_erreur_7'] = "<div id='notification-container-erreur-7'>
                                            <div id='notification-message-erreur-7'>
                                                Erreur, code : 0X008PD
                                            </div>
                                        </div>". $e->getMessage();
                                        $_SESSION['log'] ="Erreur, code : 0X008PD---".$e->getMessage();
                                        require_once("journalisation.php");

                                        $conn = null;
                                        $conn_pay = null;
                                        $conn_rsa = null;
                                        exit;

}
?>

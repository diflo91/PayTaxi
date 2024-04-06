<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Assurez-vous d'avoir initialisé $privateK avant de l'assigner à la session
$privateK = $_SESSION['private_key'];
// Clé privée RSA
$privateKey = <<<EOD
$privateK
EOD;
// Vérifiez si les données POST existent avant de les récupérer
if (isset($_POST['codeInput']) && isset($_POST['passwordInput'])) {
    // Récupérer les données chiffrées du formulaire
    $encryptedCodeInput = $_POST['codeInput'];
    $encryptedPasswordInput = $_POST['passwordInput'];

    // Déchiffrer les données avec la clé privée RSA
    openssl_private_decrypt(base64_decode($encryptedCodeInput), $decryptedCodeInput, $privateKey);
    openssl_private_decrypt(base64_decode($encryptedPasswordInput), $decryptedPasswordInput, $privateKey);

    // Connexion à la base de données
    require ("connexion_utilisateur.php");

    // Préparation de la requête SQL
    $sql = "SELECT * FROM users_auth WHERE email_utilisateur = :email AND mot_de_passe_utilisateur = :password";
    $stmt = $conn_util->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(':email', $decryptedCodeInput);
    $stmt->bindParam(':password', $decryptedPasswordInput);

    // Exécution de la requête
    $stmt->execute();

    // Récupération du résultat
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Vérifier si des lignes ont été retournées (c'est-à-dire si l'utilisateur existe)
    if ($result) {
        // L'utilisateur existe dans la base de données
        require_once("gestion_session_log.php");
        header("Location: ../index1.php");
        $conn_util = null;
        exit;
    } else {
        session_destroy();
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  // Date dans le passé
        $cookie_name = "mon_cookie"; 
        $expiration_date = time() - 3600;

        setcookie($cookie_name, "", $expiration_date, "/");
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["failed"] ="L'identifiant ou le mot de passe incorrect !";
        $_SESSION['log'] ="L'identifiant ou le mot de passe incorrect !"."---ID---".$decryptedCodeInput. "----"."PWD---".$decryptedPasswordInput;
        require_once("journalisation.php");
        header("Location: ../../index.php");
        exit; // Assurez-vous de terminer le script ici pour éviter toute exécution supplémentaire 
    }

    // Fermeture de la connexion
    $conn_util = null;

} else {
    echo "Données POST non présentes.";
}
?>

<?php
session_start();
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

  require ("connect_db.php");
    
  $sql = "SELECT * FROM users WHERE id=? AND pwd=?";
  $stmt = $conn->prepare($sql);
  // Liage des paramètres
  $stmt->bind_param("ss", $decryptedCodeInput, $decryptedPasswordInput);
  // Exécution de la requête
  $stmt->execute();
  // Récupération du résultat
  $result = $stmt->get_result();
    
    // Vérifier si des lignes ont été retournées (c'est-à-dire si l'utilisateur existe)
    if ($result->num_rows > 0) {
        // L'utilisateur existe dans la base de données
        echo "Utilisateur trouvé";   
    } else {
        session_destroy();
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  // Date dans le passé
        $cookie_name = "mon_cookie"; 
        $expiration_date = time() - 3600;
             setcookie($cookie_name, "", $expiration_date, "/");
             header("Location: ../public/lg-pg.php");
       exit; // Assurez-vous de terminer le script ici pour éviter toute exécution supplémentaire 
    }
    
    // Fermeture de la connexion
    $stmt->close();
    $conn->close();

    














} else {
    echo "Données POST non présentes.";
}
?>


 
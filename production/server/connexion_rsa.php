<?php
 if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$servername = "localhost"; // Nom du serveur MySQL
$username = "kaysoft"; // Nom d'utilisateur MySQL
$password = "11111111"; // Mot de passe MySQL
$dbname = "kaysoft_kpsa_ath"; // Nom de la base de données

try {
    // Création de la connexion PDO
    $conn_rsa = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Définir le mode d'erreur PDO sur Exception
    $conn_rsa->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vous pouvez maintenant effectuer vos opérations avec la base de données ici
    
} catch(PDOException $e_rsa) {
  $e_rsa->getMessage();
    // Si une exception PDO est levée, stocke le message d'erreur dans la session
    $_SESSION['notification_db_connexion'] = "  <div id='notification-container-erreur-4'>
    <div id='notification-message-erreur-4'>
    Echec de la connexion, code : X0785RSA contacter le service technique
    </div>
    </div> " ; 
    $_SESSION['log'] ="Echec de la connexion, code : X0785RSA contacter le service technique---".$e_rsa->getMessage();
    require_once("journalisation.php");
    // Affiche le message d'erreur
    die("Connection failed: " . $e_rsa->getMessage());
}
// Si la connexion réussit, vous pouvez exécuter d'autres opérations ici
$_SESSION['notification_db_connexion'] = "";
?>

<?php
$servername = "localhost"; // Nom du serveur MySQL
$username = "kaysoft"; // Nom d'utilisateur MySQL
$password = "11111111"; // Mot de passe MySQL
$dbname = "kaysoft_utilisateurs_db"; // Nom de la base de données

try {
    // Création de la connexion PDO
    $conn_util = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Définir le mode d'erreur PDO sur Exception
    $conn_util->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vous pouvez maintenant effectuer vos opérations avec la base de données ici
    
} catch(PDOException $e_util) {
  $e_util->getMessage();
    // Si une exception PDO est levée, stocke le message d'erreur dans la session
    $_SESSION['notification_db_connexion_utilisateur'] = "  <div id='notification-container-erreur_utilisateur'>
    <div id='notification-message-erreur_utilisateur'>
    Echec de la connexion, code : X004KKL contacter le service technique
    </div>
    </div> " ; 
    $_SESSION['log'] ="Echec de la connexion, code : X004KGH contacter le service technique---".$e_util->getMessage();
    require_once("journalisation.php");
    
    // Affiche le message d'erreur
    die("Connection failed: " . $e_util->getMessage());
}
// Si la connexion réussit, vous pouvez exécuter d'autres opérations ici
$_SESSION['notification_db_connexion_utilisateur'] = "";
?>

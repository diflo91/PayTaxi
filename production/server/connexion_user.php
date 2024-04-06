<?php

$servername = "localhost"; // Nom du serveur MySQL
$username = "kaysoft"; // Nom d'utilisateur MySQL
$password = "11111111"; // Mot de passe MySQL
$dbname = "kaysoft_users_db"; // Nom de la base de données

try {
    // Création de la connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Définir le mode d'erreur PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vous pouvez maintenant effectuer vos opérations avec la base de données ici
    
} catch(PDOException $e) {
  $e->getMessage();
    // Si une exception PDO est levée, stocke le message d'erreur dans la session
    $_SESSION['notification_db_connexion'] = "  <div id='notification-container-erreur'>
    <div id='notification-message-erreur'>
    Echec de la connexion, code : X001CDB contacter le service technique
    </div>
    </div> " ; 
    $_SESSION['log'] ="Echec de la connexion, code : X001CDB contacter le service technique---".$e->getMessage();
    require_once("journalisation.php");
    
    // Affiche le message d'erreur
    die("Connection failed: " . $e->getMessage());
}
// Si la connexion réussit, vous pouvez exécuter d'autres opérations ici
$_SESSION['notification_db_connexion'] = "";
?>

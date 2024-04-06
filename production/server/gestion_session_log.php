<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    
if (isset($decryptedCodeInput) && isset($decryptedPasswordInput)) {
       require_once("connexion_utilisateur.php");

$req = $conn_util->prepare('SELECT * FROM users_auth WHERE email_utilisateur = :email AND mot_de_passe_utilisateur = :passwords');
$req->execute(array('email' => $decryptedCodeInput, 'passwords' => $decryptedPasswordInput));
$data = $req->fetchAll(PDO::FETCH_ASSOC);

if (isset($data))  {
    foreach ($data as $row) {
        $_SESSION["nom_utilisateur"] = $row['nom_utilisateur'];
        $_SESSION["prenom_utilisateur"] = $row['prenom_utilisateur'];
        $_SESSION["log"] =  $_SERVER['REMOTE_ADDR']."---".$row['nom_utilisateur']."-".$row['prenom_utilisateur']."---est connecté---";
        $row['privilege_utilisateur'];

           if ($row['privilege_utilisateur'] != 'Administrateur') {
              $_SESSION['administrateur'] = "style='display : none;'";
           } 





         require_once("log_tracker.php");
        }
    }

} else {
    $_SESSION["failed"] ="Session echouée";
    $_SESSION['log'] ="Session echouée !"."---ID---".$decryptedCodeInput. "----"."PWD---".$decryptedPasswordInput;
    require_once("log_tracker.php");
    session_destroy();
    header("Location: ../../index.php");
    exit; // Assurez-vous de terminer le script ici pour éviter toute exécution supplémentaire 
}
?>

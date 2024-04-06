<?php

if (session_status() == PHP_SESSION_NONE) {
    // Démarrer la session si aucune n'est active
    session_start();
}
// Fonction pour ajouter un message au journal
function addToLog($message) {
    // Chemin vers le fichier de journalisation
    $logFile = "journalisation/net_activity.txt";

    
    // Récupérer l'adresse IP de l'utilisateur
    $ip_address = $_SERVER['REMOTE_ADDR'];
    // Formater le message avec la date et l'heure actuelles
    $formattedMessage = date('Y-m-d H:i:s') . " ---"."IP :" .$ip_address."---". $message . PHP_EOL;

    // Ajouter le message au fichier de journalisation
    if (file_put_contents($logFile, $formattedMessage, FILE_APPEND | LOCK_EX) === false) {
        // Gérer les erreurs si l'écriture dans le fichier échoue
        error_log("Erreur lors de l'écriture dans le fichier de journalisation", 0);
    }
}

// Exemple d'utilisation : ajouter un message au journal

if(isset($_POST['net_activity'])) {
    // Stocker la valeur du téléphone dans la session
    $_SESSION['net_activity2'] = $_POST['net_activity'];
}

if(isset($_SESSION['net_activity'])) {
    addToLog( $_SESSION['net_activity']); 
    $_SESSION['net_activity'] = "";
}


if(isset($_SESSION['net_activity2'])) {
    
    addToLog( $_SESSION['net_activity2']); 
    $_SESSION['net_activity2'] = "";
}


?>

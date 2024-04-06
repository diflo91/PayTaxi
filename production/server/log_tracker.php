<?php
if (session_status() == PHP_SESSION_NONE) {
    // Démarrer la session si aucune n'est active
    session_start();
}

// Vérifier si la fonction addToLog n'existe pas déjà avant de la déclarer
if (!function_exists('addToLog')) {
    // Déclaration de la fonction pour ajouter un message au journal
    function addToLog($message) {
        // Chemin vers le fichier de journalisation
        $logFile = "../journalisation/log.txt";

        // Formater le message avec la date et l'heure actuelles
        $formattedMessage = date('Y-m-d H:i:s') . " - " . $message . PHP_EOL;

        // Ajouter le message au fichier de journalisation
        if (file_put_contents($logFile, $formattedMessage, FILE_APPEND | LOCK_EX) === false) {
            // Gérer les erreurs si l'écriture dans le fichier échoue
            error_log("Erreur lors de l'écriture dans le fichier de journalisation", 0);
        }
    }
}

// Exemple d'utilisation : ajouter un message au journal

if(isset($_POST['bug'])) {
    // Stocker la valeur du téléphone dans la session
    $_SESSION['log2'] = $_POST['bug'];
}

if(isset($_SESSION['log'])) {
    addToLog( $_SESSION['log']); 
    $_SESSION['log'] = "";
}

if(isset($_SESSION['log2'])) {
    addToLog( $_SESSION['log2']); 
    $_SESSION['log2'] = "";
}


?>

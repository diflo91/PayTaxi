<?php

session_start();
// Fonction pour ajouter un message au journal
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

// Exemple d'utilisation : ajouter un message au journal

addToLog( $_SESSION['notification_db_connexion_valider']);
?>

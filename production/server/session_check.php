<?php
//session_start(); // Démarre la session si ce n'est pas déjà fait

// Vérifie si la variable de session existe
//if (isset($_SESSION['log'])) {
    // Si la variable de session existe, affiche son contenu
   // echo "" . $_SESSION['log'];
//} else {
    // Si la variable de session n'existe pas, affiche un message d'erreur
   // echo "La variable de session n'existe pas.";
//}



// Démarrer la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo $_SESSION['administrateur'];

?>

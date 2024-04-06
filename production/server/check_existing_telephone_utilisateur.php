<?php
session_start();

// Vérifier si la clé 'telephone_utilisateur' existe dans la requête POST
if(isset($_POST['telephone_utilisateur'])) {
    // Stocker la valeur du téléphone dans la session
    $_SESSION['message_10_utilisateur'] = $_POST['telephone_utilisateur'];

    // Récupérer la valeur du téléphone depuis la session
    $telephone_utilisateur = $_SESSION['message_10_utilisateur'];

    // Connexion à la base de données
    require_once("connexion_utilisateur.php");

    // Préparation de la requête SQL pour vérifier si le numéro de téléphone existe
    $sql = "SELECT COUNT(*) AS count FROM users_auth WHERE telephone_utilisateur = :telephone_utilisateur";
    $stmt = $conn_util->prepare($sql);
    $stmt->bindParam(':telephone_utilisateur', $telephone_utilisateur);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le numéro de téléphone existe dans la base de données
    if ($result['count'] > 0) {
        // Envoyer une réponse JSON indiquant que le numéro de téléphone existe
        $_SESSION['existe_utilisateur'] = "Existe déjà dans notre système";
    } else {
        // Envoyer une réponse JSON indiquant que le numéro de téléphone n'existe pas
        $_SESSION['existe_utilisateur'] = "Valide";
    }
} else {
    // Si la clé 'telephone_utilisateur' n'existe pas dans la requête POST, envoyer une réponse JSON d'erreur
    $_SESSION['existe_utilisateur'] = "Erreur : Le numéro de téléphone n'a pas été fourni dans la requête.";
}

// Retourner une réponse JSON
echo json_encode(['message' => $_SESSION['existe_utilisateur']]);
?>

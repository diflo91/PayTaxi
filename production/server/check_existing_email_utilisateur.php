<?php
session_start();

// Vérifier si la clé 'email' existe dans la requête POST
if(isset($_POST['email_utilisateur']) && $_POST['provider_utilisateur']) {
    // Stocker la valeur du téléphone dans la session
    $_SESSION['message_10_utilisateur'] = $_POST['email_utilisateur']."@".$_POST['provider_utilisateur'];

    // Récupérer la valeur du téléphone depuis la session
    $email = $_SESSION['message_10_utilisateur'];

    // Connexion à la base de données
    require_once("connexion_utilisateur.php");

    // Préparation de la requête SQL pour vérifier si le numéro de téléphone existe
    $sql = "SELECT COUNT(*) AS count FROM users_auth WHERE email_utilisateur = :email_utilisateur";
    $stmt = $conn_util->prepare($sql);
    $stmt->bindParam(':email_utilisateur', $email_utilisateur);
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
} 


echo json_encode(['message' => $_SESSION['existe_utilisateur']]);
?>

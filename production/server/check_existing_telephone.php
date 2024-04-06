<?php
session_start();

// Vérifier si la clé 'telephone' existe dans la requête POST
if(isset($_POST['telephone'])) {
    // Stocker la valeur du téléphone dans la session
    $_SESSION['message_10'] = $_POST['telephone'];

    // Récupérer la valeur du téléphone depuis la session
    $telephone = $_SESSION['message_10'];

    // Connexion à la base de données
    require_once("connexion_user.php");

    // Préparation de la requête SQL pour vérifier si le numéro de téléphone existe
    $sql = "SELECT COUNT(*) AS count FROM collaborateur_cdt WHERE telephone = :telephone";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le numéro de téléphone existe dans la base de données
    if ($result['count'] > 0) {
        // Envoyer une réponse JSON indiquant que le numéro de téléphone existe
        $_SESSION['existe'] = "Existe déjà dans notre système";
    } else {
        // Envoyer une réponse JSON indiquant que le numéro de téléphone n'existe pas
        $_SESSION['existe'] = "Valide";
    }
} 


echo json_encode(['message' => $_SESSION['existe']]);

?>

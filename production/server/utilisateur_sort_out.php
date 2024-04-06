<?php
try {
  require_once('connexion_utilisateur.php');
    // Requête SQL
    $stmt = $conn_util->prepare("SELECT * FROM users_auth");
    $stmt->execute();

    // Vérification s'il y a des résultats
    if ($stmt->rowCount() > 0) {
        // Affichage des données
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-4 col-sm-4  profile_details">';
            echo '<div class="well profile_view cadran_coll">';
            echo '<div class="col-sm-12">';
            echo '<h4 class="brief"><i>Collaborateur</i></h4>';
            echo '<div class="left col-md-7 col-sm-7">';
            echo '<h2>' . htmlspecialchars($row["nom_utilisateur"]."-".$row["postnom_utilisateur"]) . '</h2>';
            echo '<br>';
            echo '<li><i class="fa "></i> Sexe : ' . htmlspecialchars($row["sexe_utilisateur"]) . '</li>';
           
            echo '<li><i class="fa "></i> Telephone : ' . htmlspecialchars($row["telephone_utilisateur"]) . '</li>';
            echo '<li><i class="fa "></i> Email : ' . htmlspecialchars($row["email_utilisateur"]) . '</li>';
            echo '<li><i class="fa "></i> Privilege : ' . htmlspecialchars($row["privilege_utilisateur"]) . '</li>';
            echo '</ul>';
            echo '</div>';
            
            echo '<div class="right col-md-5 col-sm-5 text-center">';
            echo '<img src="images/img.jpg" alt="" class="img-circle img-fluid">';
            echo '</div>';
            echo '</div>';
            echo '<div class=" profile-bottom text-center">';
            echo '<div class=" col-sm-6 emphasis">';
            echo '<p class="ratings">';
       
           
            echo '</p>';
            echo '</div>';
            echo '<div class=" col-sm-6 emphasis">';
            echo '<button type="button" class="btn btn-success btn-sm"> <i class="fa fa-user"></i> <i class="fa fa-comments-o">Contacter</i> </button>';
            echo '<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-user"> </i> Profile</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Fermeture de la connexion
$conn_util = null;
?>


<?php
try {
  require_once('connexion_user.php');
    // Requête SQL
    $stmt = $conn->prepare("SELECT * FROM collaborateur_cdt");
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
            echo '<h2>' . htmlspecialchars($row["nom"]."-".$row["postnom"]) . '</h2>';
           
            echo '<li><i class="fa fa-phone"></i> Telephone: ' . htmlspecialchars($row["telephone"]) . '</li>';
            echo '<li><i class="fa fa-phone"></i> Email: ' . htmlspecialchars($row["email"]) . '</li>';
         echo '<br>';
            echo '<li><i class="fa fa-building"></i> Adresse: ' . htmlspecialchars($row["avenue_adresse"]) . '</li>';
            echo '<li><i ></i> &nbsp;&nbsp;&nbsp;&nbsp;Numero: ' . htmlspecialchars($row["numero_adresse"]) . '</li>';
            echo '<li><i ></i> &nbsp;&nbsp;&nbsp;&nbsp;Quartier: ' . htmlspecialchars($row["quartier_adresse"]) . '</li>';
            echo '<li><i ></i> &nbsp;&nbsp;&nbsp;&nbsp;Commube: ' . htmlspecialchars($row["commune_adresse"]) . '</li>';
            echo '<li><i ></i> &nbsp;&nbsp;&nbsp;&nbsp;Ville: ' . htmlspecialchars($row["ville_adresse"]) . '</li>';
            echo '<li><i ></i> &nbsp;&nbsp;&nbsp;&nbsp;Province: ' . htmlspecialchars($row["province_adresse"]) . '</li>';
           
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
$conn = null;
?>


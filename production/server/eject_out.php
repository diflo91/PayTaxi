<?php 
          if (isset($_SESSION["nom_utilisateur"]) && isset($_SESSION["prenom_utilisateur"])) {

          } else {
      
            session_destroy();
            header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  // Date dans le passé
            $cookie_name = "mon_cookie"; 
            $expiration_date = time() - 3600;
            setcookie($cookie_name, "", $expiration_date, "/");
            header("Location: ../index.php"); // HTTP/1.1

          }




?>
<?php

require_once("connexion_user.php");
require_once("connexion_rsa.php");
require_once("connexion_banque_info.php");
require_once("connexion_utilisateur.php");
$conn = null;
$conn_util = null;
$conn_rsa = null;
$conn_pay = null;

        session_destroy();
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  // Date dans le passé
        $cookie_name = "mon_cookie"; 
        $expiration_date = time() - 3600;

        setcookie($cookie_name, "", $expiration_date, "/");
    
        header("Location: ../../index.php"); // HTTP/1.1






?>
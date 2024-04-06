<?php
// Démarrer la session
if(session_status() === PHP_SESSION_NONE) {
session_start();
}
// Inclure l'autoloader de Composer si vous avez installé PHPseclib via Composer
require '../../vendor/autoload.php';
use phpseclib3\Crypt\RSA;

// Générer une paire de clés RSA
$private = RSA::createKey();
$public = $private->getPublicKey();

$privateString = $private->__toString();
$publicString = $public->__toString();
// Sauvegarder la clé privée dans la session
$_SESSION['private_key'] = $privateString;
$_SESSION['public_key'] = $publicString;
$_SESSION['log'] ="La clé de chiffrement generée avec succès";

echo json_encode(['public_key' => $publicString]);
?>

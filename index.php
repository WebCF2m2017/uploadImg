<?php

/* 
 * Contrôleur frontal
 */

// start session
session_start();

// on essaye de se connecter
try{
    $connect = new PDO('mysql:host=localhost;dbname=mvc_5', "root", "");
// on récupère l'erreur au cas où    
}catch(PDOException $e){
    // on affiche un message d'erreur
    echo "<h1>".$e->getMessage()."</h1>";
    
}
// affichage d'erreur sql, pour debuggage (dev)
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// pour charger toutes les bibliothèques installées via composer
require_once 'vendor/autoload.php';

// création du loader twig
$loader = new Twig_Loader_Filesystem('v');
$twig = new Twig_Environment($loader/*, array(
    'cache' => 'cache',
)*/);
$twig->addGlobal('_get', $_GET);
// récupération du contrôleur

// connection or disconnect
if(isset($_POST['login'])||isset($_GET['deco'])){
    require_once "c/ConnectController.php";
// Admin
}elseif (isset($_SESSION['maclef'])){
    require_once "c/AdminController.php";
// Public
}else {
    require_once 'c/PublicController.php';
}


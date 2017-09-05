<?php

/* 
 * Contrôleur frontal
 */

$connect = new PDO('mysql:host=localhost;dbname=mvc_5', "root", "");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


require_once 'vendor/autoload.php';

// création du loader twig
$loader = new Twig_Loader_Filesystem('v');
$twig = new Twig_Environment($loader/*, array(
    'cache' => 'cache',
)*/);

require_once 'c/ImagesController.php';


<?php

// chargement des dépendances
require_once 'm/ImagesManager.php';
require_once 'm/CategManager.php';

// création des manager's
$manImages = new ImagesManager($connect);
$manCateg = new CategManager($connect);

// on récupère les rubriques pour le menu
$recup_menu = $manCateg->afficheToutes();
//var_dump($recup_menu);

if(isset($_GET['idcateg'])&& ctype_digit($_GET['idcateg'])) {
    // on récupère les images de la catégorie
    $ToutesImg = $manImages->AfficheParCateg($_GET['idcateg']);
    // info categ
    $infoCateg = $manCateg->afficheUne($_GET['idcateg']);
    echo $twig->render("categ.html.twig",["infos"=>$infoCateg,"imgt"=>$ToutesImg,"menu"=>$recup_menu,"connect"=>true]);
} else {
    // var_dump(ImagesManager::AfficheDossier("./m/"));
    $ToutesImg = $manImages->AfficheTous();
    //var_dump($ToutesImg);
    echo $twig->render("accueil.html.twig",["imgt"=>$ToutesImg,"menu"=>$recup_menu,"connect"=>true]);
}
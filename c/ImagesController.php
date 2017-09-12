<?php

// chargement des dépendances
require_once 'm/UploadImg.php';
require_once 'm/Images.php';
require_once 'm/ImagesManager.php';
require_once 'm/Categ.php';
require_once 'm/CategManager.php';

// création des manager's
$manImages = new ImagesManager($connect);
$manCateg = new CategManager($connect);

// on récupère les rubriques pour le menu
$recup_menu = $manCateg->afficheToutes();
//var_dump($recup_menu);

// si on a envoyé le formulaire ET qu'on a un fichier uploadé
if (!empty($_POST) && !empty($_FILES['limage'])) {
    // rajout à la variable post du nom temporaire du fichier uplaodé
    $_POST['nom']=$_FILES['limage']['tmp_name'];
    // pour récupérer la taille de l'image en pixel
    $imgInfo = getimagesize($_POST['nom']);
    // récupération de la largeur en pixel
    $_POST['largeOrigine']=$imgInfo[0];
    // récupération de la hauteur en pixel
    $_POST['hautOrigine']=$imgInfo[1];
    //var_dump($_POST, $imgInfo);
    // création d'une instance de UploadImg
    $upImg= new UploadImg($_FILES['limage']);
    // création du fichier dans /resize (redimention avec proportions gardées) L/H/ qualité jpg
    $upImg->makeResize($imgInfo[0],$imgInfo[1],800,600,90);
    // création du fichier dans /thumbs (redimention avec crop en carré de 150 sur 150 px) + qualité jpg
    $upImg->makeThumbs($imgInfo[0],$imgInfo[1],150,60);
    // modification de la variable POST nom avec le nouveau nom de fichier (nouveauNomFichier) venant de UploadImg (public)
    $_POST['nom']=$upImg->nouveauNomFichier;
    // création de l'image pour l'insertion dans la db
    $objImg = new Images($_POST);
    // insertion dans la db
    $obj = $manImages->InsertImg($objImg);
    if($obj){
        header("Location: ./");
    }else{
        echo "<h1>Erreur lors de l'insertion</h1>";
    }
    
    //var_dump($_POST, $_FILES['limage'],$objImg,$upImh);
} elseif(isset($_GET['upload'])) {
    echo $twig->render("form.html.twig");
} else {
    // var_dump(ImagesManager::AfficheDossier("./m/"));
    $ToutesImg = $manImages->AfficheTous();
    //var_dump($ToutesImg);
    echo $twig->render("accueil.html.twig",["imgt"=>$ToutesImg]);
}
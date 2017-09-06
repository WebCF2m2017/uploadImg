<?php

require_once 'm/UploadImg.php';
require_once 'm/Images.php';

if (!empty($_POST) && !empty($_FILES['limage'])) {
    $_POST['nom']=$_FILES['limage']['tmp_name'];
    $imgInfo = getimagesize($_POST['nom']);
    $_POST['largeOrigine']=$imgInfo[0];
    $_POST['hautOrigine']=$imgInfo[1];
    $upImh= new UploadImg($_FILES['limage']);
    $_POST['nom']=$upImh->nouveauNomFichier;
    $objImg = new Images($_POST);
    
    var_dump($_POST, $_FILES['limage'],$objImg,$upImh);
} else {
    echo $twig->render("form.html.twig");
}
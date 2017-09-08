<?php

/**
 * Description of UploadImg
 *
 * @author webform
 */
class UploadImg {

    // Attributs
    private  $extensions = [".jpg",".jpeg", ".gif", ".png"];
    private  $chemin = "v/upload/";
    public   $nouveauNomFichier;
    private  $taille;
    private  $extFichier;

    // Constantes
    const TAILLEMAX = 100000000; // +- 100 mio

    // méthodes

    public function __construct(Array $fichier) {
        // si pas d'erreurs
        if ($fichier['error'] == 0) {
            // var_dump($fichier);
            // si extension valide    
            if ($this->VerifExtend($fichier['name'])) {
                // si le fichier n'est pas trog grand 
                if ($this->VerifTaille($fichier['size'])) {
                    // création du nouveau nom de fichier
                    $this->nouveauNomFichier = $this->NouveauNom();
                    // on essaye d'envoyer physiquement le fichier
                    if(move_uploaded_file($fichier['tmp_name'], $this->chemin."original/".$this->nouveauNomFichier)){
                        return [$this->nouveauNomFichier];
                    }else{
                        echo "Erreur inconnue lors du transfert";
                    }
                } else {
                    echo "fichier trop lourd! " . $this->taille . " sur " . self::TAILLEMAX . " autorisée!";
                }
            } else {
                echo "extension non valide";
            }
        } else {
            echo "Erreur inconnue lors du transfert";
        }
    }

    private  function VerifExtend($nomOrigine) {
        $string = strrchr($nomOrigine, "."); // on récupère l'extension avec le dernier .
        $ext = strtolower($string); // on met la chaine en minuscule
        // si l'extension est dans le tableau
        if (in_array($ext, $this->extensions)) {
            // on remplit l'attribut
            $this->extFichier = $ext;
            return true;
        } else {
            return false;
        }
    }

    private  function VerifTaille($taille) {
        $this->taille = $taille;
        if($taille>self::TAILLEMAX){
            return false;
        }else{
            return true;
        }
    }
    private  function NouveauNom() {
        $sortie = date("YmdHis"); // format datetime sans séparateur
        $hasard = mt_rand(10000, 99999);
        return $sortie."_".$hasard.$this->extFichier;
    }
    
    public function makeResize($largeurOri,$hauteurOri,$largeurMax,$hauteurMax,$qualityJpg){
        
        // si la largeur d'origine est plus petite que la largeur maximum et idem hauteur origine/hauteur maximum
        if($largeurOri<$largeurMax && $hauteurOri<$hauteurMax){
            $largeurFinal = $largeurOri;
            $hauteurFinal = $hauteurOri;
        }else{
            // si l'image est en paysage
            if($largeurOri>$hauteurOri){
                // pour obtenir le ratio (proportion)
                $proportion = $largeurMax/$largeurOri;                             
            // l'image est en mode portrait ou un carré    
            }else{
                // pour obtenir le ratio (proportion)
                $proportion = $hauteurMax/$hauteurOri;           
            }
            // mise en proportion de la largeur et hauteur finales
            $largeurFinal = round($largeurOri*$proportion);
            $hauteurFinal = round($hauteurOri*$proportion);
        }
        //var_dump($largeurFinal,$hauteurFinal);
        // création du fichier vierge aux tailles finales
        $newImg = imagecreatetruecolor($largeurFinal, $hauteurFinal);
        
        // on va copier l'image originale suivant son extension
        if($this->extFichier == ".jpg"||$this->extFichier == ".jpeg"){
            // en jpg
            $copie = imagecreatefromjpeg($this->chemin."original/".$this->nouveauNomFichier);
            // on adapte l'image au bon format, puis on colle
            imagecopyresampled($newImg, $copie, 0, 0, 0, 0, $largeurFinal, $hauteurFinal, $largeurOri, $hauteurOri);
            // on finalise le fichier jpg
            imagejpeg($newImg, $this->chemin."resize/".$this->nouveauNomFichier, $qualityJpg);
        }elseif($this->extFichier == ".png"){
            // en png
            $copie = imagecreatefrompng($this->chemin."original/".$this->nouveauNomFichier);
            // on adapte l'image au bon format, puis on colle
            imagecopyresampled($newImg, $copie, 0, 0, 0, 0, $largeurFinal, $hauteurFinal, $largeurOri, $hauteurOri);
            // on finalise le fichier png
            imagepng($newImg, $this->chemin."resize/".$this->nouveauNomFichier);
        }else{
            // en gif
            $copie = imagecreatefromgif($this->chemin."original/".$this->nouveauNomFichier);
             // on adapte l'image au bon format, puis on colle
            imagecopyresampled($newImg, $copie, 0, 0, 0, 0, $largeurFinal, $hauteurFinal, $largeurOri, $hauteurOri);
            // on finalise le fichier png
            imagegif($newImg, $this->chemin."resize/".$this->nouveauNomFichier);
        }
        
    }

}

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
    private  $nouveauNomFichier;
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
                    $this->$nouveauNomFichier = $this->NouveauNom();
                    // on essaye d'envoyer physiquement le fichier
                    if(move_uploaded_file($fichier['tmp_name'], $this->$chemin."original/".$this->$nouveauNomFichier)){
                        return true;
                    }else{
                        echo "Erreur inconnue lors du transfert";
                    }
                } else {
                    echo "fichier trop lourd! " . $this->$taille . " sur " . $this->TAILLEMAX . " autorisée!";
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
        if (in_array($ext, $this->$extensions)) {
            // on remplit l'attribut
            $this->$extFichier = $ext;
            return true;
        } else {
            return false;
        }
    }

    private  function VerifTaille($taille) {
        $this->$taille = $taille;
        if($taille>$this->TAILLEMAX){
            return false;
        }else{
            return true;
        }
    }
    private  function NouveauNom() {
        $sortie = date("YmdHis"); // format datetime sans séparateur
        $hasard = mt_rand(10000, 99999);
        return $sortie."_".$hasard.$this->$extFichier;
    }
    public  function AfficheDossier() {
        // doit renvoyer tout ce qu'il y a dans le dossier
        $fichiers = scandir($this->$chemin);
        // on ne prend que les valeurs non communes des 2 tableaux (pour supprimer . et ..)
        $fichier = array_diff($fichiers, [".",".."]);
        return $fichier;
    }

}

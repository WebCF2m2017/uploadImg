<?php

/**
 * Description of ImagesManager
 *
 * @author webform
 */
class ImagesManager {
    // Attributs
    private $db;
    // Constantes
    // méthodes
    public function __construct(PDO $c) {
        $this->db = $c;
    }
    public function AfficheTous(){
        $sql = "SELECT * FROM images ORDER BY nom DESC";
        $req = $this->db->query($sql);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function InsertImg(Images $img){

        $sql = "INSERT INTO images (titre,`desc`,nom,largeOrigine,hautOrigine) VALUES (?,?,?,?,?);";
        $req = $this->db->prepare($sql);
        $req->bindValue(1, $img->getTitre(),PDO::PARAM_STR);
        $req->bindValue(2, $img->getDesc(),PDO::PARAM_STR);
        $req->bindValue(3, $img->getNom(),PDO::PARAM_STR);
        $req->bindValue(4, $img->getLargeOrigine(),PDO::PARAM_INT);
        $req->bindValue(5, $img->getHautOrigine(),PDO::PARAM_INT);
        try{
            $req->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        /*if($req->rowCount()){
            return true;
        }else{
            return false;
        }*/
        // idem en ternaire
        $sortie = ($req->rowCount())? true : false;
        return $sortie;
    }
        public static function AfficheDossier($url) {
        // doit renvoyer tout ce qu'il y a dans le dossier
        $fichiers = scandir($url);
        // on ne prend que les valeurs non communes des 2 tableaux (pour supprimer . et ..)
        $fichier = array_diff($fichiers, [".",".."]);
        return $fichier;
    }
}

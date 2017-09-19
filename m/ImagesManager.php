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
    public function AfficheParCateg($id){
        // ici soucis
        $sql = "SELECT i.* FROM images i 
                INNER JOIN images_has_categ h
                    ON h.images_idimages=idimages
                INNER JOIN categ c
                    ON h.categ_idcateg = c.idcateg
                WHERE c.idcateg=? ;";
        
        $req = $this->db->prepare($sql);
        $req->bindValue(1, $id, PDO::PARAM_INT);
        $req->execute();
        if($req->rowCount()){
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    
    private function ImgJointureCateg(int $id, array $categ) {
        //var_dump($id, $categ);
        $sql="INSERT INTO images_has_categ (images_idimages,categ_idcateg) VALUES (?,?)";
        $prep = $this->db->prepare($sql);
        $prep->bindParam(1, $id, PDO::PARAM_INT);
        foreach($categ as $valeur){
            $prep->bindParam(2,$valeur, PDO::PARAM_INT);
            $prep->execute();
            }
        }
    
    public function InsertImg(Images $img){
        var_dump($img);
        $sql = "INSERT INTO images (titre,`desc`,nom,largeOrigine,hautOrigine,users_idusers) VALUES (?,?,?,?,?,?);";
        $req = $this->db->prepare($sql);
        $req->bindValue(1, $img->getTitre(),PDO::PARAM_STR);
        $req->bindValue(2, $img->getDesc(),PDO::PARAM_STR);
        $req->bindValue(3, $img->getNom(),PDO::PARAM_STR);
        $req->bindValue(4, $img->getLargeOrigine(),PDO::PARAM_INT);
        $req->bindValue(5, $img->getHautOrigine(),PDO::PARAM_INT);
        $req->bindValue(6, $img->getUsers_idusers(),PDO::PARAM_INT);
        try{
            // exécution
            $req->execute();
            // récupération de l'id de k'image
            $id = $this->db->lastInsertId();
            // pour insérer dans le tableau de jointure
            $this->ImgJointureCateg($id,$img->getCateg_idcateg());
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

}

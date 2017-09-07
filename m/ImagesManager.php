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
        public static function AfficheDossier($url) {
        // doit renvoyer tout ce qu'il y a dans le dossier
        $fichiers = scandir($url);
        // on ne prend que les valeurs non communes des 2 tableaux (pour supprimer . et ..)
        $fichier = array_diff($fichiers, [".",".."]);
        return $fichier;
    }
}

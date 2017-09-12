<?php

/**
 * Description of CategManager
 *
 * @author webform
 */
class CategManager {
    // Attributs
    private $db;
    // Constantes
    // méthodes
    public function __construct(PDO $con) {
        $this->db = $con;
    }
    
    public function afficheToutes() {
        $req = $this->db->query("SELECT * FROM categ ORDER BY intitule ASC;");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}

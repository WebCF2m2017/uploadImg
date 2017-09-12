<?php

/**
 * Description of Images
 *
 * @author webform
 */
class Images {
    // Attributs
    //mapping table images
    private $idimages;
    private $titre;
    private $desc;
    private $nom;
    private $largeOrigine;
    private $hautOrigine;
    
    // attribut de jointure avec categ pour $recup_menu
    private $categ_idcateg;
    
    // Constantes
    // méthodes
     public function __construct(Array $datas) {
        $this->hydrate($datas);
    }
    
    // hydratation
    private function hydrate(Array $a) {
        foreach ($a AS $clef => $valeur){
            $maMethode = "set".ucfirst($clef);
            if(method_exists($this, $maMethode)){
                $this->$maMethode($valeur);
            }
        }
    }
    public function getIdimages() {
        return $this->idimages;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDesc() {
        return $this->desc;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getLargeOrigine() {
        return $this->largeOrigine;
    }

    public function getHautOrigine() {
        return $this->hautOrigine;
    }

    public function setIdimages($idimages) {
        $this->idimages = $idimages;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDesc($desc) {
        $this->desc = $desc;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setLargeOrigine($largeOrigine) {
        $this->largeOrigine = $largeOrigine;
    }

    public function setHautOrigine($hautOrigine) {
        $this->hautOrigine = $hautOrigine;
    }
    public function getCateg_idcateg() {
        return $this->categ_idcateg;
    }

    public function setCateg_idcateg($categ_idcateg) {
        $this->categ_idcateg = $categ_idcateg;
    }



}

<?php

/**
 * Description of Categ
 *
 * @author webform
 */
class Categ {
    // Attributs
    private $idcateg;
    private $intitule;
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
    
    public function getIdcateg() {
        return $this->idcateg;
    }

    public function getIntitule() {
        return $this->intitule;
    }

    public function setIdcateg($idcateg) {
        $this->idcateg = $idcateg;
    }

    public function setIntitule($intitule) {
        $this->intitule = $intitule;
    }


    
}

<?php

/**
 * Description of Users
 *
 * @author webform
 */
class Users {
    // Attributs
    private $idusers;
    private $login;
    private $pwd;
    private $droits_iddroits;
    // méthodes
    // constructeur
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
    public function getIdusers() {
        return $this->idusers;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPwd() {
        return $this->pwd;
    }

    public function getDroits_iddroits() {
        return $this->droits_iddroits;
    }

    public function setIdusers($idusers) {
        $this->idusers = (int)$idusers;
    }

    public function setLogin($login) {
        $this->login = htmlspecialchars(strip_tags(trim($login)),ENT_QUOTES);
    }

    public function setPwd($pwd) {
        $this->pwd = htmlspecialchars(trim($pwd),ENT_QUOTES);
    }

    public function setDroits_iddroits($droits_iddroits) {
        $this->droits_iddroits = (int)$droits_iddroits;
    }

}

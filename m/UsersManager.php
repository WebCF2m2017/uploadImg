<?php

/**
 * Description of UsersManager
 *
 * @author webform
 */
class UsersManager {
    // Attribute
    private $db;
    // Constants
    // methods
    public function __construct(PDO $c) {
        $this->db = $c;
    }
    // method to connect with users instance
    public function ConnectUser(Users $u)
    {
        // on met dans des variables locales le login et le mdp
        $login = $u->getLogin();
        $mdp = $u->getPwd();
        // request
        $sql = "SELECT * FROM users WHERE login = ? AND pwd = ?";
        // prepare
        $req = $this->db->prepare($sql);
        // attribution of values
        $req->bindValue(1,$login,PDO::PARAM_STR);
        $req->bindValue(2,$mdp,PDO::PARAM_STR);
        // execution
        $req->execute();
        // if it's a real user
        if($req->rowCount()){
            return $req->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: webform
 * Date: 18/09/2017
 * Time: 15:38
 */

if (isset($_GET['deco'])) {
    // Détruit toutes les variables de session
    $_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

// Finalement, on détruit la session.
    session_destroy();

// redirection vers l'accueil
    header("Location: ./");
}

require_once "m/Users.php";
require_once "m/UsersManager.php";

if (isset($_POST['login']) && isset($_POST['pwd'])) {
    $util = new Users($_POST);
    //var_dump($util);
    $manageUtil = new UsersManager($connect);
    $recupUtil = $manageUtil->ConnectUser($util);
    if($recupUtil){
        $_SESSION = $recupUtil;
        $_SESSION['maclef']= session_id();
        var_dump($_SESSION);
    }
}
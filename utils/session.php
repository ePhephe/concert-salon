<?php

/**
 * Fonctions de gestion de la session
 */



/**
 * Active le mécanisme de sssion
 *
 * @return boolean - True si l'utilisateur est connecté sinon false
 */
function session_activation(){
    session_start();

    //Vérifier si l'utilisateur est toujours actif*
    if(session_isconnected()){
        global $objUserConnected;
        $objUserConnected = new compte(session_idconnected());
    }

    return session_isconnected();
}


/**
 * Retourne s'il y a une connexion active ou non
 *
 * @return boolean - True si l'utilisateur est connecté sinon false
 */
function session_isconnected(){
    return ! empty($_SESSION["id"]);
}

/**
 * Retourne l'id de l'utilisateur connecté
 *
 * @return integer - Retour l'id de l'utilisateur ou 0 s'il n'y a pas de connexion active
 */
function session_idconnected(){
    if(session_isconnected()){
        return $_SESSION["id"];
    }
    else {
        return 0;
    }
}

/**
 * Retourne l'objet correspondant à l'utilisateur connecté
 *
 * @return mixed - Objet de la classe qui gère les utilisateurs de l'application
 */
function session_userconnected(){
    if(session_isconnected()){
        global $objUserConnected;
        return $objUserConnected;
    }
    else {
        return new compte();
    }
}

/**
 * session_deconnect
 *
 * @return void
 */
function session_deconnect(){
    $_SESSION["id"]= 0;
}

/**
 * session_connect
 *
 * @return void
 */
function session_connect($id){
    $_SESSION["id"] = $id;
}

<?php

/**
 * Contrôleur : Retourne le nombre de messages non lus au format json
 * Paramètres :
 *      GET idCompte - Identifiant d'un compte
 */


//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";


/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'une conversation en paramètre sinon on redirige vers la page de login
if(isset($_GET["idCompte"])) {
    $idCompte = $_GET["idCompte"];
}
else {
    $array["nbMessagesNonlus"] = 0;
}


/**
 * Traitements
 */
$objCompte = new compte($idCompte);
$array["nbMessagesNonlus"] = $objCompte->nbMessageNonlu();

/**
 * Affichage du template
 */
echo json_encode($array);
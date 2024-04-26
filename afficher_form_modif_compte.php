<?php

/**
 * Contrôleur : Préparer et afficher le formulaire de modification d'un compte utilisateur
 * Paramètres :
 *      GET idCompte - Identifiant du compte à modifier
 */

//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un compte en paramètre et s'il correspond au compte connecté sinon on redirige à l'accueil
if(isset($_GET["idCompte"])) {
    $idCompte = $_GET["idCompte"];
    if($idCompte != session_idconnected()) {
        include "templates/pages/form_login.php";
        exit;
    }
}
else {
    include "templates/pages/form_login.php";
    exit;
}


/**
 * Traitements
 */
$objCompteModif = new compte($idCompte);

/**
 * Affichage du template
 */
//On affiche la page du formulaire de modification d'un compte
include "templates/pages/form_modif_compte.php";
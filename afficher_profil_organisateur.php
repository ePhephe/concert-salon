<?php

/**
 * Contrôleur : Préparer et afficher les informations du profil organisateur
 * Paramètres :
 *      GET idCompte - Identifiant du compte
 */

 //Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un compte en paramètre et qu'il correspond à celui connecté sinon on redirige vers la page de login
if(isset($_GET["idCompte"])) {
    $idCompte = $_GET["idCompte"];
    if($idCompte != session_idconnected()) {
        include "templates/pages/form_login.php";
        exit;
    }
    $objCompte = new compte($idCompte);
}
else {
    include "templates/pages/form_login.php";
    exit;
}

/**
 * Traitements
 */
//On vérifie si le compte connecté a un profil organisateur
$idOrganisateur = $objCompte->isOrganisateur();
if($idOrganisateur === 0) {
    include "templates/pages/form_crea_profil_organisateur.php";
    exit;
}
else {
    //On charge l'objet de l'organisateur
    $objOrganisateur = new organisateur($idOrganisateur);
    //On charge les représentations lancées par l'organisateur
    $objRepresentation = new representation();
    $arrayRepresentations = $objRepresentation->list([["champ"=>"organisateur","valeur"=>$idOrganisateur,"operateur"=>"="]]);
}

/**
 * Affichage du template
 */
//On affiche la page d'un profil organisateur
include "templates/pages/profil_organisateur.php";
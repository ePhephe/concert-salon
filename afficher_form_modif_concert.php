<?php

/**
 * Contrôleur : Prépare et affiche le formulaire de modification d'un concert
 * Paramètres :
 *      GET idConcert - Identifiant du concert à modifier
 */

//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un concert en paramètre sinon on redirige vers la page de login
if(isset($_GET["idConcert"])) {
    $idConcert = $_GET["idConcert"];
    //On instancie l'objet du concert
    $objConcert = new concert($idConcert);
    //On teste aussi si l'artiste du concert est bien celui connecté
    if($objCompte->isArtiste() != $objConcert->get("artiste")->id()) {
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
//N.C

/**
 * Affichage du template
 */
//On affiche la page du formulaire de modification d'un concert
include "templates/pages/form_modif_concert.php";
<?php

/**
 * Contrôleur : Préparer et afficher le formulaire de création d'un nouveau concert
 * Paramètres :
 *      GET idArtiste - Identifiant de l'artiste qui propose le concert
 */

//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un artiste en paramètre sinon on redirige vers la page de login
if(isset($_GET["idArtiste"])) {
    $idArtiste = $_GET["idArtiste"];
    //On teste aussi si l'artiste est bien celui connecté
    if($objCompte->isArtiste() != $idArtiste) {
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
//On affiche la page du formulaire de création d'un concert
include "templates/pages/form_crea_concert.php";
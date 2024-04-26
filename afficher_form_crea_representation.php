<?php

/**
 * Contrôleur : Préparer et afficher le formulaire de création d'une nouvelle représentation
 * Paramètres :
 *      GET idConcert - (Facultatif) Identifiant du concert pour lequel on crée une représentation
 */

//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a un identifiant d'un concert en paramètre alors on le récupère
if(isset($_GET["idConcert"])) {
    $idConcert = $_GET["idConcert"];
}
else {
    $idConcert = 0;
}
//On teste aussi si on est bien un organisateur sinon on retourne à la page de login
if($objCompte->isOrganisateur() === 0) {
    include "templates/pages/form_login.php";
    exit;
}

/**
 * Traitements
 */
//On récupère la liste des concerts possibles
$objConcert = new concert();
$arrayConcerts = $objConcert->listAll();

/**
 * Affichage du template
 */
//On affiche la page du formulaire de création d'une représentation
include "templates/pages/form_crea_representation.php";
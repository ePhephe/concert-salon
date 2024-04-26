<?php

/**
 * Contrôleur : Prépare et affiche le formulaire de modification d'une représentation
 * Paramètres :
 *      GET idRepresentation - Identifiant de la représentation
 */

//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'une présentation en paramètre sinon on redirige vers la page de login
if(isset($_GET["idRepresentation"])) {
    $idRepresentation = $_GET["idRepresentation"];
    //On instancie l'objet de la représentation pour vérifier si on a le droit de modifier
    $objRepresentation = new representation($idRepresentation);
    //On teste aussi si l'organisateur est bien celui connecté
    if($objCompte->isOrganisateur() != $objRepresentation->get("organisateur")->id()) {
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
//On récupère les concerts possibles
$objConcert = new concert();
$arrayConcerts = $objConcert->listAll();

/**
 * Affichage du template
 */
//On affiche la page du formulaire de modification d'une représentation
include "templates/pages/form_modif_representation.php";
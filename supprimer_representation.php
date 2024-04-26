<?php

/**
 * Contrôleur : Supprimer une représentation
 * Paramètres :
 *      GET idRepresentation - Identifiant de la représentation à supprimer
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";
 require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'une représentation en paramètre sinon on redirige vers la page de login
if(isset($_GET["idRepresentation"])) {
    $idRepresentation = $_GET["idRepresentation"];
    //On instancie l'objet du concert pour vérifier si on a le droit de supprimer
    $objRepresentation = new representation($idRepresentation);
    //On teste aussi si l'artiste est bien celui connecté
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
//On supprimer la représentation
$boolResultat = $objRepresentation->delete();
if($boolResultat === false) {
    $arrayErreur[] = "Erreur lors de la suppression de la représentation.";
}

//On récupère la liste des représentations
$arrayRepresentations = $objRepresentation->listAll();

/**
 * Affichage du template
 */
//On affiche la page de liste des représentations si tout est bon sinon on réaffiche la page
include "templates/pages/liste_representations.php";
<?php

/**
 * Contrôleur : Supprimer un concert
 * Paramètres :
 *      GET idConcert - Identifiant du concert à supprimer
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
    //On instancie l'objet du concert pour vérifier si on a le droit de supprimer
    $objConcert = new concert($idConcert);
    //On teste aussi si l'artiste est bien celui connecté
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
//On supprimer le concert
$boolResultat = $objConcert->delete();
if($boolResultat === false) {
    $arrayErreur[] = "Erreur lors de la suppression du concert.";
}

//On récupère la liste des concerts
$arrayConcerts = $objConcert->listAll();

/**
 * Affichage du template
 */
//On affiche la page de liste des concerts si tout est bon sinon on réaffiche la page
include "templates/pages/liste_concerts.php";
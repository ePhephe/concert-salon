<?php

/**
 * Contrôleur : Modifier un concert
 * Paramètres :
 *      GET idConcert - Identifiant du concert à modifier
 *      POST - Tableau des informations sur le concert
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
    //On instancie l'objet du concert pour vérifie si on a le droit de modifier
    $objConcert = new concert($idConcert);
    //On teste aussi si l'artiste est bien celui connecté
    if($objCompte->isArtiste() != $objConcert->get("artiste")->id()) {
        include "templates/pages/form_login.php";
        exit;
    }

    //On vérifie si on a les éléments du formulaire en POST
    if(isset($_POST["duree"])) {
        $intDuree = $_POST["duree"];
        $floatPrix = $_POST["prix"];
        $strRegion = $_POST["region"];
        $strTypeLieu = $_POST["type_lieu"];
    }
    else {
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
//On initialise nos variables de tests
$arrayErreur = [];
$boolResultat = true;
//On vérifie que les informations ont bien été saisies
if(empty($intDuree) || empty($floatPrix) || empty($strRegion) || empty($strTypeLieu)) {
    $boolResultat = false;
    $arrayErreur[] = "Merci de bien renseigner tous les champs pour la modification du concert.";
}
// Si tous les champs sont correctement remplis, on passe à la modification du concert
if($boolResultat === true) {
    //On initialise les paramètres
    $objConcert->set("duree",$intDuree);
    $objConcert->set("prix",$floatPrix);
    $objConcert->set("region",$strRegion);
    $objConcert->set("type_lieu",$strTypeLieu);

    $boolResultat = $objConcert->update();

    if($boolResultat === false) {
        $arrayErreur[] = "Erreur lors de la modification du concert.";
    }
}

/**
 * Affichage du template
 */
//On affiche la page de liste des concerts si tout est bon sinon on réaffiche la page
if($boolResultat === true) {
    $arrayConcerts = $objConcert->listAll();
    include "templates/pages/liste_concerts.php";
}
else {
    $strErreur = implode("<br>",$arrayErreur);
    include "templates/pages/form_crea_concert.php";
}
<?php

/**
 * Contrôleur : Modifier une représentation
 * Paramètres :
 *      GET idRepresentation - Identifiant de la représentation à modifier
 *      POST - Tableau des informations sur la représentation
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
    //On instancie l'objet du concert pour vérifie si on a le droit de modifier
    $objRepresentation = new representation($idRepresentation);
    //On teste aussi si l'organisateur est bien celui connecté
    if($objCompte->isOrganisateur() != $objRepresentation->get("organisateur")->id()) {
        include "templates/pages/form_login.php";
        exit;
    }

    //On vérifie si on a les éléments du formulaire en POST
    if(isset($_POST["concert"])) {
        $idConcert = $_POST["concert"];
        $datetimeRepresentation = $_POST["date_representation"];
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
if(empty($idConcert) || empty($datetimeRepresentation)) {
    $boolResultat = false;
    $arrayErreur[] = "Merci de bien renseigner tous les champs pour la modification de la représentation.";
}
// Si tous les champs sont correctement remplis, on passe à la modification de la représentation
if($boolResultat === true) {
    //On initialise les paramètres
    $objRepresentation->set("concert",$idConcert);
    $objRepresentation->set("date_representation",$datetimeRepresentation);

    $boolResultat = $objRepresentation->update();

    if($boolResultat === false) {
        $arrayErreur[] = "Erreur lors de la modification de la représentation.";
    }
}

/**
 * Affichage du template
 */
//On affiche la page de liste des représentations si tout est bon sinon on réaffiche la page
if($boolResultat === true) {
    $arrayRepresentations = $objRepresentation->listAll();
    include "templates/pages/liste_representations.php";
}
else {
    $strErreur = implode("<br>",$arrayErreur);
    include "templates/pages/form_modif_representation.php";
}
<?php

/**
 * Contrôleur : Créer une nouvelle représentation
 * Paramètres :
 *      POST - Tableau des informations sur la représentation
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";
 require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on est bien un organisateur
if($objCompte->isOrganisateur() != 0) {
    //On vérifie si on a les éléments du formulaire en POST
    if(isset($_POST["concert"])) {
        $idConcert = $_POST["concert"];
        $idOrganisateur = $objCompte->isOrganisateur() ;
        $datetimeRepresentation = $_POST["date_representation"];
    }
    else {
        include "templates/pages/form_crea_representation.php";
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
    $arrayErreur[] = "Merci de bien renseigner tous les champs pour la création de la représentation.";
}
// Si tous les champs sont correctement remplis, on passe à la création du concert
if($boolResultat === true) {
    //On instancie l'objet concert et on initialise les paramètres
    $objRepresentation = new representation();
    $objRepresentation->set("concert",$idConcert);
    $objRepresentation->set("date_representation",$datetimeRepresentation);
    $objRepresentation->set("organisateur",$idOrganisateur);

    //On va tester si le concert est disponible pour la date demandée
    $boolResultat = $objRepresentation->get("concert")->dispo($datetimeRepresentation);
    if($boolResultat === false) {
        $arrayErreur[] = "Le concert n'est pas disponible à la date demandée.";
    }
    else {
        //On réalise la création de la répresentation
        $boolResultat = $objRepresentation->insert();
        if($boolResultat === false) {
            $arrayErreur[] = "Erreur lors de la création de la représentation.";
        }
    }
}


/**
 * Affichage du template
 */
//On affiche la page de liste des concerts si tout est bon sinon on réaffiche la page
if($boolResultat === true) {
    $arrayRepresentations = $objRepresentation->listAll();
    include "templates/pages/liste_representations.php";
}
else {
    $strErreur = implode("<br>",$arrayErreur);
    $arrayConcerts = $objRepresentation->get("concert")->listAll();
    include "templates/pages/form_crea_representation.php";
}
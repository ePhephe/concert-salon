<?php

/**
 * Contrôleur : Créer le profil organisateur pour un compte
 * Paramètres :
 *      GET idCompte - Identifiant du compte rattaché au profil organisateur
 *      POST arrayArtiste - Tableau des informations sur l'organisateur
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un compte en paramètre sinon on redirige vers la page de login
if(isset($_GET["idCompte"])) {
    $idCompte = $_GET["idCompte"];
    //On vérifie si on a les éléments du formulaire en POST
    if(isset($_POST["ville_organisateur"])) {
        $strVilleOrganisateur = $_POST["ville_organisateur"];
        $strDescriptionLieu = $_POST["description_lieu"];
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
//On vérifie qu'un profil a bien été choisi
if(empty($strVilleOrganisateur) || empty($strDescriptionLieu)) {
    $boolResultat = false;
    $arrayErreur[] = "Merci de bien renseigner tous les champs pour la création de votre profil organisateur.";
}
// Si tous les champs sont correctement remplis, on passe à la création du profil
if($boolResultat === true) {
    $objNewOrganisateur = new organisateur();
    $objNewOrganisateur->set("ville_organisateur",$strVilleOrganisateur);
    $objNewOrganisateur->set("description_lieu",$strDescriptionLieu);
    $objNewOrganisateur->set("compte",$idCompte);

    $boolResultat = $objNewOrganisateur->insert();
}


/**
 * Affichage du template
 */
//On affiche la page de login si tout est bon sinon on réaffiche le formulaire
if($boolResultat === true) {
    include "templates/pages/form_login.php";
}
else {
    $strErreur = implode("<br>",$arrayErreur);
    include "templates/pages/form_crea_profil_organisateur.php";
}
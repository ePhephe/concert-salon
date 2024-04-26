<?php

/**
 * Contrôleur : Créer le profil artiste pour un compte
 * Paramètres :
 *      GET idCompte - Identifiant du compte rattaché au profil artiste
 *      POST arrayArtiste - Tableau des informations sur l'artiste
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
    if(isset($_POST["nom_scene"])) {
        $strNomScene = $_POST["nom_scene"];
        $strPresentation = $_POST["presentation"];
        $strDescriptionMusique = $_POST["description_musique"];
        $strTypeMusique = $_POST["type_musique"];
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
//On vérifie que tous les champs sont bien renseignés
if(empty($strNomScene) || empty($strPresentation) || empty($strDescriptionMusique) || empty($strTypeMusique)) {
    $boolResultat = false;
    $arrayErreur[] = "Merci de bien renseigner tous les champs pour la création de votre profil artiste.";
}
// Si tout les champs sont correctement remplis, on passe à la création du profil
if($boolResultat === true) {
    $objNewArtiste = new artiste();
    $objNewArtiste->set("nom_scene",$strNomScene);
    $objNewArtiste->set("presentation",$strPresentation);
    $objNewArtiste->set("description_musique",$strDescriptionMusique);
    $objNewArtiste->set("type_musique",$strTypeMusique);
    $objNewArtiste->set("compte",$idCompte);

    $boolResultat = $objNewArtiste->insert();
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
    include "templates/pages/form_crea_profil_artiste.php";
}
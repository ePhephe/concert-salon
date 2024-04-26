<?php

/**
 * Contrôleur : Modifier les informations d'un profil artiste
 * Paramètres :
 *      GET idArtiste - Identifiant du profil artiste à modifier
 *      POST - Informations du formulaire
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";
 require_once "utils/verif_connexion.php";

 /**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant de profil artiste en paramètre sinon on redirige vers la page de login
if(isset($_GET["idArtiste"])) {
    $idArtiste = $_GET["idArtiste"];
    //On teste si l'artiste est bien pour le profil connecté
    if($idArtiste != $objCompte->isArtiste()) {
        include "templates/pages/form_login.php";
        exit;
    }
    //On instancie un objet de la classe compte
    $objArtiste = new artiste($idArtiste);
    //On vérifie que l'on a les paramètres de modification du profil artiste sinon on réaffiche le formulaire de modification
    if(isset($_POST["nom_scene"])) {
        $strNomScene = $_POST["nom_scene"];
        $strPresentation = $_POST["presentation"];
        $strDescriptionMusique = $_POST["description_musique"];
        $strTypeMusique = $_POST["type_musique"];
    }
    else {
        include "templates/pages/form_modif_artiste.php";
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
    $arrayErreur[] = "Merci de bien renseigner tous les champs pour la modification de votre profil artiste.";
}
// Si tout les champs sont correctement remplis, on passe à la création du profil
if($boolResultat === true) {
    $objArtiste->set("nom_scene",$strNomScene);
    $objArtiste->set("presentation",$strPresentation);
    $objArtiste->set("description_musique",$strDescriptionMusique);
    $objArtiste->set("type_musique",$strTypeMusique);

    $boolResultat = $objArtiste->update();
}


 /**
 * Affichage du template
 */
//On affiche la page du formulaire de modification du profil
if($boolResultat === false) {
    $strErreur = implode("<br>",$arrayErreur);
}

include "templates/pages/form_modif_artiste.php";

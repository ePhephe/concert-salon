<?php

/**
 * Contrôleur : Modifier les informations d'un profil organisateur
 * Paramètres :
 *      GET idOrganisateur - Identifiant du profil organisateur à modifier
 *      POST - Informations du formulaire
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";
 require_once "utils/verif_connexion.php";

 /**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant de profil organisateur en paramètre sinon on redirige vers la page de login
if(isset($_GET["idOrganisateur"])) {
    $idOrganisateur = $_GET["idOrganisateur"];
    //On teste si l'artiste est bien pour le profil connecté
    if($idOrganisateur != $objCompte->isOrganisateur()) {
        include "templates/pages/form_login.php";
        exit;
    }
    //On instancie un objet de la classe compte
    $objOrganisateur = new organisateur($idOrganisateur);
    //On vérifie que l'on a les paramètres de modification du profil organisateur sinon on réaffiche le formulaire de modification
    if(isset($_POST["ville_organisateur"])) {
        $strVilleOrganisateur = $_POST["ville_organisateur"];
        $strDescriptionLieu = $_POST["description_lieu"];
    }
    else {
        include "templates/pages/form_modif_organisateur.php";
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
if(empty($strVilleOrganisateur) || empty($strDescriptionLieu)) {
    $boolResultat = false;
    $arrayErreur[] = "Merci de bien renseigner tous les champs pour la modification de votre profil artiste.";
}
// Si tout les champs sont correctement remplis, on passe à la création du profil
if($boolResultat === true) {
    $objOrganisateur->set("ville_organisateur",$strVilleOrganisateur);
    $objOrganisateur->set("description_lieu",$strDescriptionLieu);

    $boolResultat = $objOrganisateur->update();
}


 /**
 * Affichage du template
 */
//On affiche la page du formulaire de modification du profil
if($boolResultat === false) {
    $strErreur = implode("<br>",$arrayErreur);
}

include "templates/pages/form_modif_organisateur.php";

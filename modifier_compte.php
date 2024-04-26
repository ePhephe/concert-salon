<?php

/**
 * Contrôleur : Modifier les informations d'un compte
 * Paramètres :
 *      GET idCompte - Identifiant du compte à modifier
 *      POST - Informations à modifier du compte
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";
 require_once "utils/verif_connexion.php";

 /**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un compte en paramètre sinon on redirige vers la page de login
if(isset($_GET["idCompte"])) {
    $idCompte = $_GET["idCompte"];
    //On instancie un objet de la classe compte
    $objCompteModif = new compte($idCompte);
    //On vérifie que l'on a les paramètres de création du compte sinon on réaffiche le formulaire de modification
    if(isset($_POST["email"])) {
        $strNom = $_POST["nom"];
        $strPrenom = $_POST["prenom"];
        $strEmail = $_POST["email"];
        $strPasswordOld = $_POST["passwordOld"];
        $strPassword = $_POST["password"];
        $strPasswordConfirm = $_POST["passwordConfirm"];
        $strNotif = (empty($_POST["notifEmail"])) ? "N" : "O";
    }
    else {
        include "templates/pages/form_modif_compte.php";
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
//On vérifie que l'adresse e-mail n'est pas déjà utilisé
if( $strEmail != $objCompteModif->get("email")){
    if(! $objCompteModif->emailUnique($strEmail)) {
        $boolResultat = false;
        $arrayErreur[] = "Adresse e-mail déjà utilisé pour un compte existant.";
    }
}
//On vérifie que les deux mots de passe correspondent
if( ! $objCompteModif->verificationPassword($strPasswordOld)) {
    $boolResultat = false;
    $arrayErreur[] = "Votre mot de passe actuel est incorrect.";
}
//On vérifie que les deux mots de passe correspondent
if( ! empty($strPassword)) {
    if($strPassword != $strPasswordConfirm) {
        $boolResultat = false;
        $arrayErreur[] = "Les mots de passe saisis ne correspondent pas.";
    }
}
//On vérifie qu'un profil a bien été choisi
if(empty($strNom) || empty($strPrenom) ) {
    $boolResultat = false;
    $arrayErreur[] = "Merci de bien renseigner vos nom et prénom pour la modification du compte.";
}
// Si tout les champs sont correctement remplis, on passe à la création du compte
if($boolResultat === true) {
    $objCompteModif->set("nom_compte",$strNom);
    $objCompteModif->set("prenom_compte",$strPrenom);
    $objCompteModif->set("email",$strEmail);
    if( ! empty($strPassword))
        $objCompteModif->set("password",password_hash($strPassword,PASSWORD_BCRYPT));
    $objCompteModif->set("notification_email",$strNotif);

    $boolResultat = $objCompteModif->update();
}


 /**
 * Affichage du template
 */
//On affiche la page du formulaire de modification du compte
if($boolResultat === false) 
    $strErreur = implode("<br>",$arrayErreur);

include "templates/pages/form_modif_compte.php";
<?php

/**
 * Contrôleur : Créer un compte
 * Paramètres :
 *      POST - Informations pour créer le compte
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";

 /**
 * Récupération des paramètres
 */
//On vérifie que l'on a les paramètres de création du compte sinon on réaffiche le formulaire de login
if(isset($_POST["email"])) {
    $strNom = $_POST["nom"];
    $strPrenom = $_POST["prenom"];
    $strEmail = $_POST["email"];
    $strPassword = $_POST["password"];
    $strPasswordConfirm = $_POST["passwordConfirm"];
    $strProfil = $_POST["profil"];
    $strNotif = (empty($_POST["notifEmail"])) ? "N" : "O";
}
else {
    include "templates/pages/form_crea_compte.php";
    exit;
}

/**
 * Traitements
 */
//On instancie un objet de la classe compte
$objNewCompte = new compte();
//On initialise nos variables de tests
$arrayErreur = [];
$boolResultat = true;
//On vérifie que l'adresse e-mail n'est pas déjà utilisé
if( ! $objNewCompte->emailUnique($strEmail)) {
    $boolResultat = false;
    $arrayErreur[] = "Adresse e-mail déjà utilisé pour un compte existant.";
}
//On vérifie que les deux mots de passe correspondent
if($strPassword != $strPasswordConfirm) {
    $boolResultat = false;
    $arrayErreur[] = "Les mots de passe saisis ne correspondent pas.";
}
//On vérifie qu'un profil a bien été choisi
if(empty($strProfil) || empty($strNom) || empty($strPrenom) ) {
    $boolResultat = false;
    $arrayErreur[] = "Merci de bien renseigner vos nom, prénom et profil initiale pour la création du compte.";
}
// Si tout les champs sont correctement remplis, on passe à la création du compte
if($boolResultat === true) {
    $objNewCompte->set("nom_compte",$strNom);
    $objNewCompte->set("prenom_compte",$strPrenom);
    $objNewCompte->set("email",$strEmail);
    $objNewCompte->set("password",password_hash($strPassword,PASSWORD_BCRYPT));
    $objNewCompte->set("notification_email",$strNotif);

    $boolResultat = $objNewCompte->insert();
}


 /**
 * Affichage du template
 */
//On affiche la page de création du profil correspondant si tout est bon sinon on réaffiche le formulaire
if($boolResultat === true) {
    if($strProfil === "artiste")
        header("Location:afficher_form_crea_artiste.php?idCompte=".$objNewCompte->id());
    else if($strProfil === "organisateur")
        header("Location:afficher_form_crea_organisateur.php?idCompte=".$objNewCompte->id());
}
else {
    $strErreur = implode("<br>",$arrayErreur);
    include "templates/pages/form_crea_compte.php";
}

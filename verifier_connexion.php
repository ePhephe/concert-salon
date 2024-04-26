<?php

/**
 * Contrôleur : Vérifier les informations de connexion
 * Paramètres : 
 *      POST - Informations de connexion
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";

/**
 * Récupération des paramètres
 */
//On vérifie que l'on a les paramètres de connexion sinon on réaffiche le formulaire de login
if(isset($_POST["login"])) {
    $strLogin = $_POST["login"];
    $strPassword = $_POST["password"];
}
else {
    include "templates/pages/form_login.php";
    exit;
}
 
/**
 * Traitements
 */
$objCompte = new compte();
$boolResultat = $objCompte->connexionCompte($strLogin,$strPassword);
//Si la connexion a réussi, on stocke les informations nécessaires en session
if($boolResultat === true) {
    session_connect($objCompte->id());

    //Pour afficher la page d'accueil
    //On va récupérer la liste des artites
    $objArtiste = new artiste();
    $arrayArtistes = $objArtiste->listAll();

    //On va récupérer la liste des concerts
    $objConcert = new concert();
    $arrayConcerts = $objConcert->listAll();
}
else {
    $strErreur = "Erreur de connexion, vérifiez votre login et votre mot de passe avant de réessayer.";
}

/**
 * Affichage du template
 */
//On affiche la page d'accueil si tout est bon sinon on réaffiche le formulaire
if($boolResultat === true) {
    include "templates/pages/accueil_public.php";
}
else {
    include "templates/pages/form_login.php";
}


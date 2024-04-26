<?php

/**
 * Contrôleur : Préparer et afficher le formulaire de création de profil organisateur
 * Paramètres :
 *      GET idCompte - Identifiant du compte sur lequel créer le profil organisateur
 */

//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un compte en paramètre sinon on redirige vers la page de login
if(isset($_GET["idCompte"])) {
    $idCompte = $_GET["idCompte"];
}
else {
    include "templates/pages/form_login.php";
    exit;
}

/**
 * Traitements
 */
//N.C

/**
 * Affichage du template
 */
//On affiche la page du formulaire de création d'un profil organisateur
include "templates/pages/form_crea_profil_organisateur.php";
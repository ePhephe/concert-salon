<?php

/**
 * Contrôleur : Préparer et afficher le formulaire de modification d'un profil organisateur
 * Paramètres :
 *      GET idOrganisateur - Identifiant du profil organisateur à modifier
 */

 //Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un compte en paramètre sinon on redirige vers la page de login
if(isset($_GET["idOrganisateur"])) {
    $idOrganisateur = $_GET["idOrganisateur"];
    if($idOrganisateur != $objCompte->isOrganisateur()) {
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
//On instancie l'objet de l'organisateur
$objOrganisateur = new organisateur($idOrganisateur);

/**
 * Affichage du template
 */
//On affiche la page du formulaire de modification du profil organisateur
include "templates/pages/form_modif_organisateur.php";
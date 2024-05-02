<?php

/**
 * Contrôleur : Préparer et afficher le formulaire de création d'une nouvelle conversation
 * Paramètres :
 *      GET idOrganisateur - Identifiant de l'oganisateur qui créé la conversation
 *      GET idArtiste - (Facultatif) Identifiant de l'artiste avec qui on veut parler
 */

//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un profil organisateur en paramètre sinon on redirige vers la page de login
if(isset($_GET["idOrganisateur"])) {
    $idOrganisateur = $_GET["idOrganisateur"];
    if($objCompte->isOrganisateur() != $idOrganisateur) {
        include "templates/pages/form_login.php";
        exit;
    }
    //On récupère si un artiste est passé en paramètre
    if(isset($_GET["idArtiste"])) {
        $idArtiste = $_GET["idArtiste"];
    }
    else {
        $idArtiste = 0;
    }
}
else {
    include "templates/pages/form_login.php";
    exit;
}

/**
 * Traitements
 */
//On récupère la liste des artistes que l'on peut contacter
$objArtiste = new artiste();
$arrayArtistes = $objArtiste->listAll();

/**
 * Affichage du template
 */
//On affiche la page du formulaire de création d'une conversation
include "templates/pages/form_crea_conversation.php";
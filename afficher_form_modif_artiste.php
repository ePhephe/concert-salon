<?php

/**
 * Contrôleur : Prépare et affiche le formulaire de modification d'un profil artiste
 * Paramètres :
 *      GET idArtiste - Identifiant du profil artiste à modifier
 */

 //Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un profil artiste en paramètre sinon on redirige vers la page de login
if(isset($_GET["idArtiste"])) {
    $idArtiste = $_GET["idArtiste"];
    //On teste si l'id de l'artiste est bien celui de l'artiste connecté
    if($idArtiste != $objCompte->isArtiste()) {
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
//On instancie l'objet de l'artiste
$objArtiste = new artiste($idArtiste);

/**
 * Affichage du template
 */
//On affiche la page du formulaire de modification d'un profil artiste
include "templates/pages/form_modif_artiste.php";
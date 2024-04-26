<?php

/**
 * Contrôleur : Récupérer les informations concernant un artiste
 * Paramètres :
 *      GET idArtiste - Identifiant du profil artiste à afficher
 */

 //Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
$objCompte = session_userconnected();

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un artiste en paramètre sinon on redirige vers la page de liste des artistes
if(isset($_GET["idArtiste"])) {
    $idArtiste = $_GET["idArtiste"];
}
else {
    //On récupère la liste des tous les artistes
    $objArtiste = new artiste();
    $arrayArtistes = $objArtiste->listAll();
    //On affiche la page de liste des artistes
    include "templates/pages/liste_artistes.php";
    exit;
}

/**
 * Traitements
 */
//On charge l'objet de l'artiste
$objArtiste = new artiste($idArtiste);
//On récupère ses concerts
$arrayConcerts = $objArtiste->concerts();

/**
 * Affichage du template
 */
//On affiche la page d'un profil artiste
include "templates/pages/details_artiste.php";
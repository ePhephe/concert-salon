<?php

/**
 * Contrôleur : Préparer et afficher les informations du profil artiste
 * Paramètres :
 *      GET idCompte - Identifiant du compte
 */

 //Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un compte en paramètre et qu'il correspond à celui connecté sinon on redirige vers la page de login
if(isset($_GET["idCompte"])) {
    $idCompte = $_GET["idCompte"];
    if($idCompte != session_idconnected()) {
        include "templates/pages/form_login.php";
        exit;
    }
    $objCompte = new compte($idCompte);
}
else {
    include "templates/pages/form_login.php";
    exit;
}

/**
 * Traitements
 */
//On vérifie si le compte connecté a un profil artiste
$idArtiste = $objCompte->isArtiste();
if($idArtiste === 0) {
    include "templates/pages/form_crea_profil_artiste.php";
    exit;
}
else {
    //On charge l'objet de l'artiste
    $objArtiste = new artiste($idArtiste);
    //On charge les concerts de l'artiste
    $objConcert = new concert();
    $arrayConcerts = $objConcert->list([["champ"=>"artiste","valeur"=>$idArtiste,"operateur"=>"="]]);
    //On charge les représentations de concert de l'artiste
    $objRepresentation = new representation();
    $arrayRepresentations = $objRepresentation->listRepresentationsArtiste($idArtiste);
}

/**
 * Affichage du template
 */
//On affiche la page d'un profil artiste
include "templates/pages/profil_artiste.php";
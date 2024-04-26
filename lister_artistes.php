<?php

/**
 * Contrôleur : Afficher la liste des artistes
 * Paramètres :
 *      REQUEST - (Facultatif) Options de filtres
 */


//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
$objCompte = session_userconnected();

/**
 * Récupération des paramètres
 */
$boolFiltres = false;
if(isset($_REQUEST["nom_artiste"]) || isset($_REQUEST["type_musique"])) {
    $boolFiltres = true;
}

/**
 * Traitements
 */
//On va récupérer la liste des artistes
$objArtiste = new artiste();
if($boolFiltres === false) {
    $arrayArtistes = $objArtiste->listAll();
}
else {
    $arrayFiltres= [];
    if(!empty($_REQUEST["nom_artiste"])){
        $arrayFiltres[]=[
            "champ" => "nom_scene",
            "valeur" => $_REQUEST["nom_artiste"],
            "operateur" => "LIKE"
        ];
    }
    if(!empty($_REQUEST["type_musique"])){
        $arrayFiltres[]=[
            "champ" => "type_musique",
            "valeur" => $_REQUEST["type_musique"],
            "operateur" => "LIKE"
        ];
    }

    $arrayArtistes = $objArtiste->list($arrayFiltres);
}


/**
 * Affichage du template
 */
//On affiche la page qui liste les artistes
include "templates/pages/liste_artistes.php";
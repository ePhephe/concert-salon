<?php

/**
 * Contrôleur : Afficher la liste des concerts
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
if(isset($_REQUEST["duree_min"]) || isset($_REQUEST["duree_max"]) || isset($_REQUEST["prix_min"]) || isset($_REQUEST["prix_max"]) || isset($_REQUEST["region"]) || isset($_REQUEST["artiste"])) {
    $boolFiltres = true;
}


/**
 * Traitements
 */
//On va récupère la liste complète si on a pas de paramètres
$objConcert = new concert();
if($boolFiltres === false) {
    $arrayConcerts = $objConcert->listAll();
}
else {
    //Sinon on construit les filtres et on récupère la liste
    $arrayFiltres= [];
    if(!empty($_REQUEST["duree_min"])){
        $arrayFiltres[]=[
            "champ" => "duree",
            "valeur" => $_REQUEST["duree_min"],
            "operateur" => ">"
        ];
    }
    if(!empty($_REQUEST["duree_max"])){
        $arrayFiltres[]=[
            "champ" => "duree",
            "valeur" => $_REQUEST["duree_max"],
            "operateur" => "<"
        ];
    }
    if(!empty($_REQUEST["prix_min"])){
        $arrayFiltres[]=[
            "champ" => "prix",
            "valeur" => $_REQUEST["prix_min"],
            "operateur" => ">"
        ];
    }
    if(!empty($_REQUEST["prix_max"])){
        $arrayFiltres[]=[
            "champ" => "prix",
            "valeur" => $_REQUEST["prix_max"],
            "operateur" => "<"
        ];
    }
    if(!empty($_REQUEST["region"])){
        $arrayFiltres[]=[
            "champ" => "region",
            "valeur" => $_REQUEST["region"],
            "operateur" => "LIKE"
        ];
    }
    if(!empty($_REQUEST["artiste"])){
        $arrayFiltres[]=[
            "champ" => "artiste",
            "valeur" => $_REQUEST["artiste"],
            "operateur" => "="
        ];
    }

    $arrayConcerts = $objConcert->list($arrayFiltres);
}

//On récupère la liste des artistes pour les filtres
$objArtiste = new artiste();
$arrayArtistes = $objArtiste->listAll();

/**
 * Affichage du template
 */
//On affiche la page qui liste les concerts
include "templates/pages/liste_concerts.php";
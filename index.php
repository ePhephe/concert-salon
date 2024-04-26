<?php

/**
 * Contrôleur : Index de l'application, affiche la liste des artistes et des concerts
 * Paramètres : N.C
 */


//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
$objCompte = session_userconnected();


/**
 * Récupération des paramètres
 */
//N.C


/**
 * Traitements
 */
//On va récupérer la liste des artites
$objArtiste = new artiste();
$arrayArtistes = $objArtiste->list([],[],["offset"=>"0","limit"=>"5"]);

//On va récupérer la liste des concerts
$objConcert = new concert();
$arrayConcerts = $objConcert->list([],[],["offset"=>"0","limit"=>"5"]);

/**
 * Affichage du template
 */
//On affiche la page d'accueil qui attend un tableau des concerts et des artistes
include "templates/pages/accueil_public.php";
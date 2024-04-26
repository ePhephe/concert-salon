<?php

/**
 * Contrôleur : Afficher la liste des representations
 * Paramètres :
 *      Néant
 */


//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//N.C


/**
 * Traitements
 */
//On va récupérer la liste des représentations
$objRepresentation = new representation();
$arrayRepresentations = $objRepresentation->listAll();

/**
 * Affichage du template
 */
//On affiche la page qui liste les représentations
include "templates/pages/liste_representations.php";
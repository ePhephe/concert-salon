<?php

// Code d'initialisation à inclure en début de contrôleur

/**
 * Paramètrage des messages d'erreur
 */
//On affiche les erreurs
ini_set("display_errors", 1);   
//On affiche toutes les erreurs
error_reporting(E_ALL);

/**
 * Gestion de la base de données 
 */
//On ouvre la base de données et on stocke dans la variable globale $bdd
global $bdd;
$bdd = new PDO("mysql:host=localhost;dbname=XXX;charset=UTF8","XXX","XXX");
//On paramètre les erreurs pour debugger
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

/**
 * Chargement des librairies
 */

//Modèle pour les classes
include_once "utils/model.php";

//Classes de nos objets de base de données
include_once "modeles/artiste.php";
include_once "modeles/compte.php";
include_once "modeles/concert.php";
include_once "modeles/conversation.php";
include_once "modeles/message.php";
include_once "modeles/organisateur.php";
include_once "modeles/representation.php";

/**
 * Gestion de la session
 */
include_once "utils/session.php";
session_activation();

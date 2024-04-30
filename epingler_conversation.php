<?php

/**
 * Contrôleur : Epingle une conversation
 * Paramètres :
 *      GET idConversation - Identifiant de la conversation
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";
 require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On initialise nos variables de tests
$arrayErreur = [];
$boolResultat = true;
//On vérifie qu'on a bien l'identifiant d'une conversation en paramètre et qu'on peut envoyer un message sur cette conversation sinon on redirige vers la page de login
if(isset($_GET["idConversation"])) {
    $idConversation = $_GET["idConversation"];
    $objConversation = new conversation($idConversation);
    if($objConversation->get("organisateur")->get("compte")->id() === $objCompte->id() || $objConversation->get("artiste")->get("compte")->id() === $objCompte->id()) {

    }
    else {
        $boolResultat = false;
        $arrayErreur[] = "Vous n'êtes pas autorisé à envoyer de messages sur cette conversation ! ";
    }
}
else {
    $boolResultat = false;
    $arrayErreur[] = "Vous n'êtes pas sur une conversation ! ";
}

/**
 * Traitements
 */
//On ajoute la conversation danhs celles épinglées dans la variable de session
$_SESSION["conversation_epinglee"] = $objConversation;

//On va récupérer les messages de la conversation
$arrayMessages = $objConversation->listMessages();

/**
 * Affichage du template
 */
//On affiche la page qui liste les messages
include "templates/pages/liste_messages.php";
<?php

/**
 * Contrôleur : Afficher la liste des conversations pour un compte
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
//On va récupérer si le compte est un artiste ou un organisateur ou les deux
$idArtiste = $objCompte->isArtiste();
$idOrganisateur = $objCompte->isOrganisateur();

//On va récupérer la liste des conversations pour chaque rôle
$objConversation = new conversation();
$arrayConversationsArtiste = $objConversation->list([["champ"=>"artiste","valeur"=>$idArtiste,"operateur"=>"="]],["date_conversation"=>"desc"]);
$arrayConversationsOrganisateur = $objConversation->list([["champ"=>"organisateur","valeur"=>$idOrganisateur,"operateur"=>"="]],["date_conversation"=>"desc"]);

/**
 * Affichage du template
 */
//On affiche la page qui liste les conversations
include "templates/pages/liste_conversations.php";
<?php

/**
 * Contrôleur : Change le statut d'une conversation
 * Paramètres :
 *      GET idConversation - Identifiant de la conversation à archiver
 *      GET statut - Nouveau statut de la conversation
 */


//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'une conversation et un statut en paramètre sinon on redirige vers la page de login
if(isset($_GET["idConversation"]) && isset($_GET["statut"])) {
    $idConversation = $_GET["idConversation"];
    $strStatut = $_GET["statut"];
    //On instancie l'objet de la conversation et on vérifie qu'on a le droit de l'archiver sinon on redirige vers la page de login
    $objConversation = new conversation($idConversation);
    if($objCompte->isOrganisateur() != $objConversation->get("organisateur")->id()) {
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
//On change le statut de la conversation
$objConversation->set("statut_conversation",$strStatut);
$objConversation->update();
//On passe tous les messages de la conversation à Lu
$objConversation->setMessagesLu();

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
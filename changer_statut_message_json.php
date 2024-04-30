<?php

/**
 * Contrôleur : Change le statut d'un message
 * Paramètres :
 *      GET $idMessage - Identifiant du message à changer
 *      OU
 *      GET $idConversation - Identifiant de la conversation des messages à changer
 * 
 *      GET $statut - Nouveau statut de la conversation
 */

//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un message ou d'une conversation en paramètre sinon on redirige vers la page de login
if((isset($_GET["idMessage"]) || isset($_GET["idConversation"])) && isset($_GET["statut"])) {
    $strStatut = $_GET["statut"];
    if(isset($_GET["idMessage"])){
        $idMessage = $_GET["idMessage"];
    }
    else if(isset($_GET["idConversation"])){
        $idConversation = $_GET["idConversation"];
    } 
}

/**
 * Traitements
 */
//Soit on est dans le cas d'un message soit d'une conversation
if(!empty($idMessage)){
    //On instancie l'objet du message et on vérifie qu'on a le droit de changer son statut sinon on redirige vers la page de login
    $objMessage = new message($idMessage);
    if($objCompte->id() != $objMessage->get("compte_destinataire")->id()) {
        echo json_encode(array("error"=> "true"));
        exit;
    }
    //On met à jour le statut du message
    $objMessage->set("statut_message",$strStatut);
    $objMessage->update();

    //On instancie l'objet de la conversation
    $objConversation = new conversation($objMessage->get("conversation")->id());
    //On liste les messages de la conversation
    $arrayMessages = $objConversation->listMessages();
}
else if(!empty($idConversation)){
    //On instancie un objet conversation
    $objConversation = new conversation($idConversation);
    //On instancie un objet message
    $objMessage = new message();
    //On liste les messages de la conversation
    $arrayMessages = $objConversation->listMessages();
    //Pour chaque message dont on est destinataire, on passe change son statut
    foreach ($arrayMessages as $id => $message) {
        if($objCompte->id() === $message->get("compte_destinataire")->id()) {
            $message->set("statut_message",$strStatut);
            $message->update();
        }
    }
}

/**
 * Affichage du template
 */
 echo json_encode(array("error"=> "false"));
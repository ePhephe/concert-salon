<?php

/**
 * Contrôleur : Afficher la liste des messages d'une conversation
 * Paramètres :
 *      GET idConversation - Identifiant d'une conversation
 */


//Initialisation : on appelle le programme d'initialisation
require_once "utils/init.php";
require_once "utils/verif_connexion.php";


/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'une conversation en paramètre sinon on redirige vers la page de login
if(isset($_GET["idConversation"])) {
    $idConversation = $_GET["idConversation"];
}
else {
    include "templates/pages/form_login.php";
    exit;
}


/**
 * Traitements
 */
//On va récupérer les messages de la conversation
//On instancie l'objet de la conversation
$objConversation = new conversation($idConversation);
//On liste les messages de la conversation
$arrayMessages = $objConversation->listMessages();

$arrayMessagesJSON = [];

foreach($arrayMessages as $message) {
    $arrayMessagesJSON[] = [
        "id" => $message->id(),
        "etat" => ($message->get("compte_destinataire")->id()===$objCompte->id())?"recu":"envoye",
        "statut" => $message->get("statut_message"),
        "contenu" => nl2br(htmlentities($message->get("contenu"))),
        "dateMessage" => date("d/m/Y H:m",strtotime($message->get("date_message"))),
        "isExpediteur" => ($message->get("compte_expediteur")->id()!=$objCompte->id())?"N":"O"
    ];
}

/**
 * Affichage du template
 */
//On affiche la page qui liste les messages
echo json_encode($arrayMessagesJSON);
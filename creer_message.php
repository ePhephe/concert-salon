<?php

/**
 * Contrôleur : Créer un nouveau message
 * Paramètres :
 *      GET idConversation - Identifiant du profil organisateur à l'initiative de la conversation
 *      POST - Tableau des informations du message
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
        //On vérifie si on a les éléments du formulaire en POST
        if(isset($_POST["contenu"])) {
            $strContenu = $_POST["contenu"];
        }
        else {
            $boolResultat = false;
            $arrayErreur[] = "Aucun message n'est présent ! ";
        }
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
//On définit le destinataire en fonction de l'expéditeur
if($objConversation->get("artiste")->get("compte")->id() === $objCompte->id())
    $idDestinataire = $objConversation->get("organisateur")->get("compte")->id();
else if($objConversation->get("organisateur")->get("compte")->id() === $objCompte->id())
    $idDestinataire = $objConversation->get("artiste")->get("compte")->id();

//On vérifie que les informations ont bien été saisies
if(empty($strContenu)) {
    $boolResultat = false;
    $arrayErreur[] = "Merci de bien renseigner tous les champs pour la création de la conversation.";
}
// Si tous les champs sont correctement remplis, on passe à la création du profil
if($boolResultat === true) {
    //On instancie l'objet message et on initialise les paramètres
    $objMessage = new message();
    $objMessage->set("contenu",$strContenu);
    $objMessage->set("conversation",$objConversation->id());
    $objMessage->set("date_message",date("Y/m/d H:m:s"));
    $objMessage->set("statut_message","N");
    $objMessage->set("compte_expediteur",$objCompte->id());
    $objMessage->set("compte_destinataire",$idDestinataire);

    $boolResultat = $objMessage->insert();
}

$resultJSON = [];
$resultJSON["resulalt"] = $boolResultat;
$resultJSON["erreurs"] = $arrayErreur;

/**
 * Affichage du template
 */
//On redirige vers la page de la liste des conversations
echo json_encode($resultJSON);
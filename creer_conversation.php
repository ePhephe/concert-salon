<?php

/**
 * Contrôleur : Créer une nouvelle conversation
 * Paramètres :
 *      GET idOrganisateur - Identifiant du profil organisateur à l'initiative de la conversation
 *      POST - Tableau des informations sur la conversation et le message
 */

 //Initialisation : on appelle le programme d'initialisation
 require_once "utils/init.php";
 require_once "utils/verif_connexion.php";

/**
 * Récupération des paramètres
 */
//On vérifie qu'on a bien l'identifiant d'un organisateur en paramètre sinon on redirige vers la page de login
if(isset($_GET["idOrganisateur"])) {
    $idOrganisateur = $_GET["idOrganisateur"];
    //On vérifie si on a les éléments du formulaire en POST
    if(isset($_POST["artiste"])) {
        $idArtiste = $_POST["artiste"];
        $strObjet = $_POST["objet"];
        $strContenu = $_POST["contenu"];
    }
    else {
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
//On initialise nos variables de tests
$arrayErreur = [];
$boolResultat = true;
//On vérifie que les informations ont bien été saisies
if(empty($strObjet) || empty($strContenu) || empty($idArtiste)) {
    $boolResultat = false;
    $arrayErreur[] = "Merci de bien renseigner tous les champs pour la création de la conversation.";
}
// Si tous les champs sont correctement remplis, on passe à la création du profil
if($boolResultat === true) {
    //On instancie l'objet conversation et on initialise les paramètres
    $objConversation = new conversation();
    $objConversation->set("objet",$strObjet);
    $objConversation->set("statut_conversation","O");
    $objConversation->set("date_conversation",date("Y/m/d H:m:s"));
    $objConversation->set("organisateur",$idOrganisateur);
    $objConversation->set("artiste",$idArtiste);
    //On lance l'insert
    $boolResultat = $objConversation->insert();
    //Si la création de la conversation a fonctionné, on ajoute le premier message
    if($boolResultat === true) {
        //On instancie l'objet message et on initialise les paramètres
        $objMessage = new message();
        $objMessage->set("contenu",$strContenu);
        $objMessage->set("conversation",$objConversation->id());
        $objMessage->set("date_message",date("Y/m/d H:m:s"));
        $objMessage->set("statut_message","NL");
        $objMessage->set("compte_expediteur",$objConversation->get("organisateur")->get("compte")->id());
        $objMessage->set("compte_destinataire",$objConversation->get("artiste")->get("compte")->id());

        $boolResultat = $objMessage->insert();
    }
}


/**
 * Affichage du template
 */
//On affiche la page de liste des conversations si tout est bon
if($boolResultat === true) {
    $arrayConversationsArtiste = $objConversation->list([["champ"=>"artiste","valeur"=>$idArtiste,"operateur"=>"="]]);
    $arrayConversationsOrganisateur = $objConversation->list([["champ"=>"organisateur","valeur"=>$idOrganisateur,"operateur"=>"="]]);
    include "templates/pages/liste_conversations.php";
}
else {
    $strErreur = implode("<br>",$arrayErreur);
    include "templates/pages/form_crea_conversation.php";
}
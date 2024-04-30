<?php

/**
 * Classe conversation : classe de gestion des objets conversations
 */

class conversation extends _model {

    /**
     * Attributs
     */

    //Nom de la table dans la BDD
    protected $table = "conversation";
    //Liste des champs
    protected $fields = [ 
        "objet" => ["type"=>"text","libelle"=>"Objet de la conversation"],
        "date_conversation" => ["type"=>"date","libelle"=>"Date de la conversation"],
        "statut_conversation" => ["type"=>"text","libelle"=>"Statut de la conversation"],
        "organisateur" =>  ["type"=>"object","nom_objet"=>"organisateur","libelle"=>"Organisateur"],
        "artiste" =>  ["type"=>"object","nom_objet"=>"artiste","libelle"=>"Artiste destinataire"]
    ]; 

    /**
     * Méthodes
     */
        
    /**
     * Passe tous les messages de la conversation en lu
     *
     * @return boolean - True si les messages sont passés lus sinon False
     */
    function setMessagesLu(){
        //On récupère la liste des messages pour la conversation
        $arrayMessagesConversation = $this->listMessages();

        //On parcourt les messages et on les passe au statut lu
        foreach ($arrayMessagesConversation as $id => $message) {
            $message->set("statut_message","L");
            $message->update();
        }

        return true;
    }

    /**
     * Retourne tous les messages de la conversation
     *
     * @return array - Tableau d'objets message indexé sur l'id 
     */
    function listMessages(){
        //On instancie un objet message
        $objMessage = new message();
        //On récupère la liste des messages pour la conversation
        $arrayMessagesConversation = $objMessage->list([["champ"=>"conversation","valeur"=>$this->id,"operateur"=>"="]]);

        return $arrayMessagesConversation;
    }
}
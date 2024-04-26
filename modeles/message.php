<?php

/**
 * Classe message : classe de gestion des objets messages
 */

class message extends _model {

    /**
     * Attributs
     */

    //Nom de la table dans la BDD
    protected $table = "message";
    //Liste des champs
    protected $fields = [ 
        "contenu" => ["type"=>"text","libelle"=>"Contenu du message"],
        "date_message" =>  ["type"=>"date","libelle"=>"Date du message"],
        "statut_message" =>  ["type"=>"text","libelle"=>"Statut du message"],
        "conversation" =>  ["type"=>"object","nom_objet"=>"conversation","libelle"=>"Conversation"],
        "message_reponse" =>  ["type"=>"object","nom_objet"=>"message","libelle"=>"Réponse au message"],
        "compte_expediteur" =>  ["type"=>"object","nom_objet"=>"compte","libelle"=>"Compte auteur du message"],
        "compte_destinataire" =>  ["type"=>"object","nom_objet"=>"compte","libelle"=>"Compte destinataire du message"]
    ]; 

}
<?php

/**
 * Classe organisateur : classe de gestion des objets organisateurs
 */

class organisateur extends _model {

    /**
     * Attributs
     */

    //Nom de la table dans la BDD
    protected $table = "organisateur";
    //Liste des champs
    protected $fields = [ 
        "ville_organisateur" => ["type"=>"text","libelle"=>"Ville"],
        "description_lieu" =>  ["type"=>"text","libelle"=>"Lieu de représentation"],
        "compte" =>  ["type"=>"object","nom_objet"=>"compte","libelle"=>"Compte lié à l'organisateur"]
    ]; 

}
<?php

/**
 * Classe artiste : classe de gestion des objets artistes
 */

class artiste extends _model {

    /**
     * Attributs
     */

    //Nom de la table dans la BDD
    protected $table = "artiste";
    //Liste des champs
    protected $fields = [ 
        "nom_scene" => ["type"=>"text","libelle"=>"Nom de scène"],
        "presentation" =>  ["type"=>"text","libelle"=>"Présentation"],
        "description_musique" =>  ["type"=>"text","libelle"=>"Description du style de musique"],
        "type_musique" =>  ["type"=>"text","libelle"=>"Type de musique joué"],
        "compte" =>  ["type"=>"object","nom_objet"=>"compte","libelle"=>"Compte lié à l'artiste"]
    ]; 

    /**
     * Méthodes
     */
     
     /**
      * Retourne la liste des concerts de l'artiste
      *
      * @return array - Tableau indexé sur l'id des concerts de l'artiste
      */
     function concerts() {
        //On instancie un objet de concert
        $objConcert = new concert();
        //On récupère la liste des concerts
        return $objConcert->list([["champ"=>"artiste","valeur"=>$this->id,"operateur"=>"="]]);
     }

}
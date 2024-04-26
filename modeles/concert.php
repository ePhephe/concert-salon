<?php

/**
 * Classe concert : classe de gestion des objets concerts
 */

class concert extends _model {

    /**
     * Attributs
     */

    //Nom de la table dans la BDD
    protected $table = "concert";
    //Liste des champs
    protected $fields = [ 
        "type_lieu" => ["type"=>"text","libelle"=>"Lieux possible"],
        "duree" =>  ["type"=>"number","libelle"=>"Durée en min"],
        "prix" =>  ["type"=>"number","libelle"=>"Prix demandé"],
        "region" =>  ["type"=>"text","libelle"=>"Régions possibles"],
        "artiste" =>  ["type"=>"object","nom_objet"=>"artiste","libelle"=>"Artiste concerné"]
    ]; 

    /**
     * Méthodes
     */
     
     /**
      * Vérifie qu'un concert est disponible pour une date donnée
      *
      * @param  string $date Date et heure à vérifier
      * @return boolean - True si le concert est disponible sinon False
      */
     function dispo($date){
        //On instancie un objet representation
        $objRepresentation = new representation();
        //On récupère la liste des représentations pour ce concert et cette date
        $arrayConcertRepresentation = $objRepresentation->list([
            ["champ"=>"concert","valeur"=>$this->id,"operateur"=>"="],
            ["champ"=>"date_representation","valeur"=>$date,"operateur"=>"="]
        ]);

        if($arrayConcertRepresentation === false){
            return true;
        }
        else {
            return false;
        }
     }
}
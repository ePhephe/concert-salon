<?php

/**
 * Classe representation : classe de gestion des objets représentations
 */

class representation extends _model {

    /**
     * Attributs
     */

    //Nom de la table dans la BDD
    protected $table = "representation";
    //Liste des champs
    protected $fields = [ 
        "date_representation" => ["type"=>"date","libelle"=>"Date de la représentation"],
        "organisateur" =>  ["type"=>"object","nom_objet"=>"organisateur","libelle"=>"Organisateur de la représentation"],
        "concert" =>  ["type"=>"object","nom_objet"=>"concert","libelle"=>"Concert lié à la représentation"]
    ]; 

    /**
     * Méthodes
     */
     
     /**
      * Liste des représentations auxquelles un artiste participe
      *
      * @param  integer $idArtiste Identifiant de l'artiste
      * @return mixed - Tableau indexé sur l'id d'objets représentation ou False s'il y a une erreur
      */
     function listRepresentationsArtiste($idArtiste){
        //On construit la requête SELECT
        $arrayFields = [];
        foreach ($this->fields as $fieldName => $field) {
            $arrayFields[] = "`$fieldName`";
        }
        $strRequete = "SELECT `$this->table`.`id`, " . implode(",", $arrayFields) . " FROM `$this->table` ";
        $strRequete .= "LEFT JOIN `concert` ON `$this->table`.`concert` = `concert`.`id` ";
        $strRequete .= "WHERE `concert`.`artiste` = :idArtiste ";

        $arrayParam = [
            "idArtiste" => $idArtiste 
        ];

        //On prépare la requête
        global $bdd;
        $req = $bdd->prepare($strRequete);

        //On exécute la requête avec ses paramètres et on gère les erreurs
        if ( ! $req->execute($arrayParam)) { 
            return false;
        }

        //On récupère les résultats et on gère les erreurs
        $arrayResultats = $req->fetchAll(PDO::FETCH_ASSOC);
        if (empty($arrayResultats)) {
            return false;
        }


        // construire le tableau à retourner :
        // Pour chaque élément de $liste, fabriquer un objet contact que l'on met dans le tableau final
        $arrayObjResultat = [];
        foreach ($arrayResultats as $unResultat) {
            $newObj = new $this->table();
            $newObj->loadFromTab($unResultat);

            $arrayObjResultat[$unResultat["id"]] = $newObj;
        }
  
        return $arrayObjResultat;
     }

}
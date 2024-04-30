<?php

/**
 * Classe compte : classe de gestion des objets comptes
 */

class compte extends _model {

    /**
     * Attributs
     */

    //Nom de la table dans la BDD
    protected $table = "compte";
    //Liste des champs
    protected $fields = [ 
        "nom_compte" => ["type"=>"text","libelle"=>"Nom"],
        "prenom_compte" =>  ["type"=>"text","libelle"=>"Prénom"],
        "email" =>  ["type"=>"text","libelle"=>"Email"],
        "password" =>  ["type"=>"text","libelle"=>"Mot de passe"],
        "notification_email" =>  ["type"=>"text","libelle"=>"Notification E-mail"]
    ];

    //
    protected $idOrganisateur = 0;
    protected $idArtiste = 0;

    /**
     * Méthodes
     */
    
    /**
     * Retourne l'id du profil organisateur du compte s'il existe
     *
     * @return integer - Id du profil organisateur sinon 0
     */
    function isOrganisateur(){
        if($this->id != 0 && $this->idOrganisateur === 0) {
            //Vérification du rôle Organisateur
            //On construit la requête SELECT
            $strRequete = "SELECT `id` FROM `organisateur` WHERE `compte` = :idCompte";
            $arrayParam = [":idCompte" => $this->id];

            //On prépare la requête
            global $bdd;
            $objRequete = $bdd->prepare($strRequete);

            //On exécute la requête avec les parmaètres
            if ( ! $objRequete->execute($arrayParam)) {
                //Erreur sur la requête
                return false;
            }

            //On récupère les résultats
            $arrayResultats = $objRequete->fetchAll(PDO::FETCH_ASSOC);
            //Si le tableau est vide, on retourne une erreur (false)
            if (empty($arrayResultats)) {
                return 0;
            }

            //On récupère la ligne de résultat dans une variable
            $arrayInfos = $arrayResultats[0];

            $this->idOrganisateur = $arrayInfos["id"];

            return $this->idOrganisateur;
        }
        else {
            return $this->idOrganisateur;
        }
    }

    /**
     * Retourne l'id du profil artiste du compte s'il existe
     *
     * @return integer - Id du profil artiste sinon 0
     */
    function isArtiste(){
        if($this->id != 0 && $this->idArtiste === 0) {
            //Vérification du rôle Organisateur
            //On construit la requête SELECT
            $strRequete = "SELECT `id` FROM `artiste` WHERE `compte` = :idCompte";
            $arrayParam = [":idCompte" => $this->id];

            //On prépare la requête
            global $bdd;
            $objRequete = $bdd->prepare($strRequete);

            //On exécute la requête avec les parmaètres
            if ( ! $objRequete->execute($arrayParam)) {
                //Erreur sur la requête
                return 0;
            }

            //On récupère les résultats
            $arrayResultats = $objRequete->fetchAll(PDO::FETCH_ASSOC);
            //Si le tableau est vide, il n'y a pas de profil artiste on retourne 0
            if (empty($arrayResultats)) {
                return 0;
            }

            //On récupère la ligne de résultat dans une variable
            $arrayInfos = $arrayResultats[0];

            $this->idArtiste = $arrayInfos["id"];

            return $this->idArtiste;
        }
        else {
            return $this->idArtiste;
        }
    }
        
    /**
     * Connexion au compte utilisateur
     *
     * @param  string $strLogin Login de connexion saisi par l'utilisateur
     * @param  string $strPassword Mot de passe de connexion saisi par l'utilisateur
     * @return boolean - True si la connexion réussi sinon False
     */
    function connexionCompte($strLogin,$strPassword){
        //On construit la requête SELECT
        $strRequete = "SELECT `id`, `password` FROM `compte` WHERE `email` = :mail ";
        $arrayParam = [
            ":mail" => $strLogin
        ];

        //On prépare la requête
        global $bdd;
        $objRequete = $bdd->prepare($strRequete);

        //On exécute la requête avec les parmaètres
        if ( ! $objRequete->execute($arrayParam)) {
            return false;
        }

        //On récupère les résultats
        $arrayResultats = $objRequete->fetchAll(PDO::FETCH_ASSOC);
        //Si le tableau est vide, on retourne une erreur (false)
        if (empty($arrayResultats)) {
            return false;
        }

        //On récupère la ligne de résultat dans une variable
        $arrayInfos = $arrayResultats[0];

        if(password_verify($strPassword,$arrayInfos["password"])) {
            $this->load($arrayInfos["id"]);
            return true;
        }

        return false;
       
    }

    /**
     * Vérifie que le mot de passe passé en paramètre est le bon pour ce compte
     *
     * @param  string $strPassword Mot de passe saisi par l'utilisateur
     * @return boolean - True si le mot de passe est bon sinon False
     */
    function verificationPassword($strPassword){
        //On construit la requête SELECT
        $strRequete = "SELECT `id`, `password` FROM `compte` WHERE `id` = :id ";
        $arrayParam = [
            ":id" => $this->id
        ];

        //On prépare la requête
        global $bdd;
        $objRequete = $bdd->prepare($strRequete);

        //On exécute la requête avec les parmaètres
        if ( ! $objRequete->execute($arrayParam)) {
            return false;
        }

        //On récupère les résultats
        $arrayResultats = $objRequete->fetchAll(PDO::FETCH_ASSOC);
        //Si le tableau est vide, on retourne une erreur (false)
        if (empty($arrayResultats)) {
            return false;
        }

        //On récupère la ligne de résultat dans une variable
        $arrayInfos = $arrayResultats[0];

        if(password_verify($strPassword,$arrayInfos["password"])) {
            return true;
        }

        return false;
    }

    /**
     * Vérifie que l'adresse e-mail n'est pas déjà utilisée par un autre utilisateur
     *
     * @param  string $strEmail Email à vérifier
     * @return boolean - True si l'email n'est pas présent en BDD sinon False
     */
    function emailUnique($strEmail){
        //On vérifie que l'email est dans un format valide
        $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    
        // Test de l'adresse e-mail avec la regex
        if (! preg_match($regexEmail, $strEmail)) {
            return false;
        }

        //On construit la requête SELECT
        $strRequete = "SELECT `email` FROM `compte` WHERE `email` = :mail ";
        $arrayParam = [
            ":mail" => $strEmail
        ];

        //On prépare la requête
        global $bdd;
        $objRequete = $bdd->prepare($strRequete);

        //On exécute la requête avec les parmaètres
        if ( ! $objRequete->execute($arrayParam)) {
            return false;
        }

        //On récupère les résultats
        $arrayResultats = $objRequete->fetchAll(PDO::FETCH_ASSOC);
        //Si le tableau est vide, on retourne une erreur (false)
        if (empty($arrayResultats)) {
            return true;
        }

        return false;
    }
    
    /**
     * Indique le nombre de messages non-lus sur le compte
     *
     * @param integer $idConversation (facultatif) Identifiant d'une conversation
     * @return integer - Nombre de messages non-lus
     */
    function nbMessageNonlu($idConversation = null){
        //On instancie un objet message
        $objMessage = new message();

        //On construit les paramètres
        $arrayParam = [
            ["champ"=>"compte_destinataire","valeur"=>$this->id,"operateur"=>"="],
            ["champ"=>"statut_message","valeur"=>"NL","operateur"=>"="]
        ];
        //Si on a une conversation, on ajouter le paramètre
        if(! is_null($idConversation)){
            $arrayParam[] = ["champ"=>"conversation","valeur"=>$idConversation,"operateur"=>"="];
        }

        //On récupère la liste des messages avec le paramètre du statut non-lu et le compte en destinataire
        $arrayMessages = $objMessage->list($arrayParam);

        if($arrayMessages === false){
            return 0;
        }
        else {
            return count($arrayMessages);
        }
    }

    /**
     * Indique le nombre de messages nouveaux sur le compte et les passent en non-lus
     *
     * @param integer $idConversation (facultatif) Identifiant d'une conversation
     * @return integer - Nombre de nouveaux messages
     */
    function nbMessageNouveau($idConversation = null){
        //On instancie un objet message
        $objMessage = new message();

        //On construit les paramètres
        $arrayParam = [
            ["champ"=>"compte_destinataire","valeur"=>$this->id,"operateur"=>"="],
            ["champ"=>"statut_message","valeur"=>"N","operateur"=>"="]
        ];
        //Si on a une conversation, on ajouter le paramètre
        if(! is_null($idConversation)){
            $arrayParam[] = ["champ"=>"conversation","valeur"=>$idConversation,"operateur"=>"="];
        }

        //On récupère la liste des messages avec le paramètre du statut non-lu et le compte en destinataire
        $arrayMessages = $objMessage->list($arrayParam);

        if($arrayMessages === false){
            $nbMessage = 0;
        }
        else {
            $nbMessage = count($arrayMessages);
            foreach ($arrayMessages as $id => $message) {
                $objMessageModif = new message($id);
                $objMessageModif->set("statut_message","NL");
                $objMessageModif->update();
            }
        }

        return $nbMessage;
    }

}
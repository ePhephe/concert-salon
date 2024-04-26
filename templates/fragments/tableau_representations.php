<?php

/**
 * Template fragment : Tableau des représentations
 * Paramètres : 
 *      $arrayRepresentations - Tableau d'objets représentation indexé sur l'id
 */

//S'il n'y a pas de représentation, on affiche un message
if($arrayRepresentations === false) {
?>
    Aucune représentation n'a été créé pour l'instant ! 
<?php
}
else {
?>

<table>
    <thead>
        <tr>
            <th>Artiste</th>
            <th>Date</th>
            <th>Durée</th>
            <th>Prix</th>
            <th>Organisateur</th>
            <th>Ville</th>
            <th>Lieu</th>
<?php
    //Si l'utilisateur est connecté on affiche des colonnes supplémentaires
    if(session_isconnected()){
        //Si l'utilisateur connecté est un organisateur, on affiche deux colonnes en plus : Bouton Modifier et Bouton Supprimer
        if($objCompte->isOrganisateur() != 0) {
?>
            <th class="action"></th>
            <th class="action"></th>
<?php
        }
    }

?>
        </tr>
    </thead>
    <tbody> 
<?php
    foreach ($arrayRepresentations as $id => $representation) {        
?>
        <tr>
            <td class="important"><?= $representation->get("concert")->get("artiste")->get("nom_scene") ?></td>
            <td class="important"><?= date("d/m/Y",strtotime($representation->get("date_representation"))) ?></td>
            <td><?= $representation->get("concert")->get("duree") ?> min</td>
            <td><?= $representation->get("concert")->get("prix")  ?> €</td>
            <td><?= $representation->get("organisateur")->get("compte")->get("nom_compte") ?> <?= $representation->get("organisateur")->get("compte")->get("prenom_compte") ?></td>
            <td><?= $representation->get("organisateur")->get("ville_organisateur") ?></td>
            <td><?= $representation->get("organisateur")->get("description_lieu") ?></td>
            <?php

        //Si l'utilisateur est connecté on peut afficher des colonnes supplémentaires
        if(session_isconnected()){
            //Si l'utilisateur connecté est l'organisateur de la représentation il peut agir : Bouton Modifier et Bouton Supprimer
            if($representation->get("organisateur")->id()===$objCompte->isOrganisateur()){
?>
            <td><a href="afficher_form_modif_representation.php?idRepresentation=<?= $representation->id() ?>"><img src="img/modif_icon.png" alt="Icone modifier"></a></td>
            <td><a href="supprimer_representation.php?idRepresentation=<?= $representation->id() ?>"><img src="img/delete_icon.png" alt="Icone supprimer"></a></td>
<?php
            }
        }

?>
        </tr>
<?php
    }
}
?>
        
    </tbody>
</table>
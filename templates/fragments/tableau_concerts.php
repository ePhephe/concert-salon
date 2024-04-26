<?php

/**
 * Template fragment : Tableau des concerts
 * Paramètres : 
 *      $arrayConcerts - Tableau d'objets concerts indexé sur l'id
 */

//S'il n'y a pas de concert, on affiche un message
if($arrayConcerts === false) {
?>
    Aucun concert n'a été créé pour l'instant ! 
<?php
}
else {
?>

<table>
    <thead>
        <tr>
            <th>Artiste</th>
            <th>Type de musique</th>
            <th>Description</th>
            <th>Durée</th>
            <th>Prix</th>
            <th>Région</th>
<?php
    //Si l'utilisateur est connecté on affiche des colonnes supplémentaires
    if(session_isconnected()){
        //Si l'utilisateur connecté est un artiste, on affiche deux colonnes en plus : Bouton Modifier et Bouton Supprimer
        if($objCompte->isArtiste() != 0) {
?>
            <th class="action"></th>
            <th class="action"></th>
<?php
        }
        //Si l'utilisateur connecté est un organisateur, on affiche une colonne en plus : Bouton Organiser
        else if($objCompte->isOrganisateur() != 0){
?>
            <th class="action"></th>
<?php
        }    
    }

?>
        </tr>
    </thead>
    <tbody> 
<?php
    foreach ($arrayConcerts as $id => $concert) {        
?>
        <tr>
            <td class="important"><?= $concert->get("artiste")->get("nom_scene") ?></td>
            <td><?= $concert->get("artiste")->get("type_musique") ?></td>
            <td><?= $concert->get("artiste")->get("description_musique") ?></td>
            <td class="important"><?= $concert->get("duree") ?> min</td>
            <td class="important"><?= $concert->get("prix") ?> €</td>
            <td><?= $concert->get("region") ?></td>
            <?php

    //Si l'utilisateur est connecté on affiche des colonnes supplémentaires
    if(session_isconnected()){
        //Si l'utilisateur connecté est l'artiste du concert il peut agir : Bouton Modifier et Bouton Supprimer
        if($concert->get("artiste")->id()==$objCompte->isArtiste()) {
?>
            <td><a href="afficher_form_modif_concert.php?idConcert=<?= $concert->id() ?>" title="Modifier le concert"><img src="img/modif_icon.png" alt="Icone modifier"></a></td>
            <td><a href="supprimer_concert.php?idConcert=<?= $concert->id() ?>" title="Supprimer le concert"><img src="img/delete_icon.png" alt="Icone supprimer"></a></td>
<?php
        }
        //Si l'utilisateur connecté est un organisateur il peut agir : Bouton Organiser
        else if($objCompte->isOrganisateur() != 0){
?>
            <td><a href="afficher_form_crea_representation.php?idConcert=<?= $concert->id() ?>" title="Organiser une représentation de ce concert"><img src="img/calendar_icon.png" alt="Icone Organiser"></a></td>
<?php
        }
    }

?>
        </tr>
<?php
    }
?>
    </tbody>
</table>
<?php
}
?>
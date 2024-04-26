<?php

/**
 * Template fragment : Tableau des artistes
 * Paramètres : 
 *      $arrayArtistes - Tableau d'objets artistes indexé sur l'id
 */

//S'il n'y a pas de concert, on affiche un message
if($arrayArtistes === false) {
?>
    Aucun artiste n'est inscrit pour l'instant ! 
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
            <th>Présentation</th>
            <th class="action"></th>
            <th class="action"></th>
            <?php

            //Si l'utilisateur est connecté on affiche des colonnes supplémentaires
            if(session_isconnected()){
                //Si l'utilisateur connecté est l'artiste du concert il peut agir : Bouton Lui écrire
                if($objCompte->isOrganisateur() != 0) {
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
        foreach ($arrayArtistes as $id => $artiste) {        
    ?>
        <tr>
            <td class="important"><?= $artiste->get("nom_scene") ?></td>
            <td><?= $artiste->get("type_musique") ?></td>
            <td><?= $artiste->get("description_musique") ?></td>
            <td><?= nl2br(htmlentities($artiste->get("presentation"))) ?></td>
            <td><a href="afficher_details_artiste.php?idArtiste=<?= $artiste->id() ?>" title="Consulte la fiche de l'artiste <?= $artiste->get("nom_scene") ?>"><img src="img/detail_icon.png" alt="Icone détail"></a></td>
            <td><a href="lister_concerts.php?idArtiste=<?= $artiste->id() ?>" title="Consulte les concerts de <?= $artiste->get("nom_scene") ?>"><img src="img/concert_icon.png" alt="Icone Concert"></a></td>
            <?php

            //Si l'utilisateur est connecté on affiche des colonnes supplémentaires
            if(session_isconnected()){
                //Si l'utilisateur connecté est un organisateur : Bouton Lui écrire
                if($objCompte->isOrganisateur() != 0) {
        ?>
            <td><a href="afficher_form_crea_conversation.php?idOrganisateur=<?= $objCompte->isOrganisateur() ?>&idArtiste=<?= $artiste->id() ?>"title="Ecrire à <?= $artiste->get("nom_scene") ?>"><img src="img/write_icon.png" alt="Icone Ecrire"></a></td>
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
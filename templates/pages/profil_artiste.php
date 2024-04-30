<?php

/**
 * Template de la page de profil d'un artiste
 * Paramètres :
 *      $objArtiste - Objet de l'artiste
 *      $arrayConcerts - Tableau d'objets concert
 *      $arrayRepresentations - Tableau d'objets representation
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil d'artiste</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section>
            <h1>Mon profil d'artiste</h1>
        </section>
        <nav class="sous-menu">
            <ul>
                <li><a href="afficher_form_crea_concert.php?idArtiste=<?= $objArtiste->id() ?>">Créer un concert</a></li>
                <li><a href="lister_concerts.php?idArtiste=<?= $objArtiste->id() ?>">Gérer mes concerts</a></li>
                <li><a href="lister_representations.php?idArtiste=<?= $objArtiste->id() ?>">Voir mes représentations</a></li>
                <li><a href="afficher_form_modif_artiste.php?idArtiste=<?= $objArtiste->id() ?>">Modifier mon profil</a></li>
            </ul>
        </nav>
        <section class="infos">
            <h2>Mes informations</h2>
            <p><b>Nom de scène : </b><?= $objArtiste->get("nom_scene") ?></p>
            <p><b>Présentation : </b><?= $objArtiste->get("presentation") ?></p>
            <p><b>Description de la musique : </b><?= $objArtiste->get("description_musique") ?></p>
            <p><b>Type de musique : </b><?= $objArtiste->get("type_musique") ?></p>
        </section>
        <section>
            <h2>Mes concerts</h2>
            <?php
                include "templates/fragments/tableau_concerts.php";
            ?>
        </section>
        <section>
            <h2>Représentations auxquelles je participe</h2>
            <?php
                include "templates/fragments/tableau_representations.php";
            ?>
        </section>
        <?php
            include_once("templates/fragments/alerte_messages.php");
        ?>
    </main>
    <?php
        include_once("templates/fragments/scripts.php");
    ?>
</body>
</html>
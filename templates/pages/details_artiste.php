<?php

/**
 * Template de la page de détails pour un artiste
 * Paramètres :
 *      $objArtiste - Objet de l'artiste
 *      $arrayConcerts - Tableau d'objets concert de l'artiste indexé par l'id
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'artiste <?= $objArtiste->get("nom_scene") ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section>
            <h1>Profil de l'artiste <?= $objArtiste->get("nom_scene") ?></h1>
        </section>
        <!-- Affichage des informations de l'artiste -->
        <section class="infos">
            <h2>Mes informations</h2>
            <p><b>Nom de scène : </b><?= $objArtiste->get("nom_scene") ?></p>
            <p><b>Présentation : </b><?= $objArtiste->get("presentation") ?></p>
            <p><b>Description de la musique : </b><?= $objArtiste->get("description_musique") ?></p>
            <p><b>Type de musique : </b><?= $objArtiste->get("type_musique") ?></p>
        </section>
        <!-- Affichage des concerts proposés par l'artiste -->
        <section>
            <h2>Ses offres de concert</h2>
            <?php
                include "templates/fragments/tableau_concerts.php";
            ?>
        </section>
    </main>
</body>
</html>
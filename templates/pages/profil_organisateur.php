<?php

/**
 * Template de la page de profil d'un organisateur
 * Paramètres :
 *      $objOrganisateur - Objet de l'organisateur
 *      $arrayRepresentations - Tableau d'objets representation
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil organisateur</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section>
            <h1>Mon profil organisateur</h1>
        </section>
        <nav class="sous-menu">
            <ul>
                <li><a href="afficher_form_crea_representation.php?idOrganisateur=<?= $objOrganisateur->id() ?>">Créer une représentation</a></li>
                <li><a href="lister_representations.php?idOrganisateur=<?= $objOrganisateur->id() ?>">Gérer mes représentations</a></li>
                <li><a href="afficher_form_modif_organisateur.php?idOrganisateur=<?= $objOrganisateur->id() ?>">Modifier mon profil</a></li>
            </ul>
        </nav>
        <section class="infos">
            <h2>Mes informations</h2>
            <p><b>Description du lieu : </b><?= $objOrganisateur->get("description_lieu") ?></p>
            <p><b>Ville : </b><?= $objOrganisateur->get("ville_organisateur") ?></p>
        </section>
        <section>
            <h2>Représentations que j'organise</h2>
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
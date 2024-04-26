<?php

/**
 * Template de la page qui liste les représentations
 * Paramètres :
 *      $arrayRepresentations - Tableau d'objets representation indexé sur l'id
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des représentations</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include_once("templates/fragments/menu.php"); ?>
    <main>
        <section>
            <h1>Liste des représentations</h1>
        </section>
        <?php if(session_isconnected() && $objCompte->isArtiste() != 0){ ?>
        <nav class="sous-menu">
            <ul>
                <li><a href="afficher_form_crea_concert.php?idArtiste=<?= $objCompte->isArtiste() ?>">Créer un concert</a></li>
            </ul>
        </nav>
        <?php } ?>
        <section>
            <?php
                include_once("templates/fragments/tableau_representations.php");
            ?>
        </section>
    </main>
</body>
</html>
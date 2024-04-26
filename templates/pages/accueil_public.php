<?php

/**
 * Template de la page d'accueil
 * Paramètres :
 *      $arrayArtistes - Tableau indexé d'objets d'artistes par l'id
 *      $arrayConcerts - Tableau indexé d'objets de concerts par l'id
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organiser un concert dans mon salon</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section>
            <h1>Organiser un concert dans mon salon</h1>
        </section>
        <section>
            <h2>Nos 5 derniers concerts enregistrés</h2>
            <?php
                include_once("templates/fragments/tableau_concerts.php");
            ?>
        </section>
        <section>
            <h2>Nos 5 derniers artistes inscrits</h2>
            <?php
                include_once("templates/fragments/tableau_artistes.php");
            ?>
        </section>
    </main>
    <?php
        if(session_isconnected()){
    ?>
    <script>
        let idCompte = <?= $objCompte->id() ?>;
    </script>
    <?php
        }
    ?>
    <script src="js/app.js"></script>
</body>
</html>
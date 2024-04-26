<?php

/**
 * Template de la page qui liste les artistes
 * Paramètres :
 *      $arrayArtistes - Tableau d'objets artiste indexé sur l'id
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de nos artistes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include_once("templates/fragments/menu.php"); ?>
    <main>
        <section>
            <h1>Liste de nos artistes</h1>
        </section>
        <section>
            <b>Rechercher :</b> 
            <form action="lister_artistes.php" method="post" class="recherche">
                <label for="nom_artiste">Nom : </label>
                <input type="text" name="nom_artiste" id="nom_artiste" value="<?= (isset($_REQUEST["nom_artiste"])) ? $_REQUEST["nom_artiste"] : "" ?>">
                <label for="type_musique">Style musical : </label>
                <input type="text" name="type_musique" id="type_musique" value="<?= (isset($_REQUEST["type_musique"])) ? $_REQUEST["type_musique"] : "" ?>">
                <input type="submit" value="Filtrer">
            </form>
        </section>
        <section>
            <?php
                include_once("templates/fragments/tableau_artistes.php");
            ?>
        </section>
    </main>
</body>
</html>
<?php

/**
 * Template du formulaire de création d'un concert
 * Paramètres :
 *      $idArtiste - Identifiant de l'artiste à l'origine du concert
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposer un nouveau concert</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Créer un nouveau concert</h1>
            <!-- Formulaire de création d'un concert -->
            <form action="creer_concert.php?idArtiste=<?= $idArtiste ?>" method="post" class="crea-artiste">
                <div class="w45">
                    <label for="duree">Durée du concert (en minutes):</label>
                    <input type="number" name="duree" id="duree" required>
                </div>
                <div class="w45">
                    <label for="prix">Prix de la prestation (€) :</label>
                    <input type="number" name="prix" id="prix" step="0.01" required>
                </div>
                <div class="w100">
                    <label for="region">Région(s) possible(s) :</label>
                    <input type="text" name="region" id="region" required>
                </div>
                <div class="w100">
                    <label for="type_lieu">Type de lieu nécessaire :</label>
                    <input type="text" name="type_lieu" id="type_lieu" required>
                </div>
                <input type="submit" value="Valider">
            </form>
            <?php
            if(isset($boolResultat) && $boolResultat === false) {
            ?>
                <div class="erreur">
                    <?= $strErreur ?>
                </div>
            <?php
            }
            ?>
        </section>
    </main>
</body>
</html>
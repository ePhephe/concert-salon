<?php

/**
 * Template du formulaire de modification d'un concert
 * Paramètres :
 *      $objConcert - Objet du concert à modifier
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un concert</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Modifier le concert</h1>
            <form action="modifier_concert.php?idConcert=<?= $objConcert->id() ?>" method="post" class="crea-artiste">
                <div class="w45">
                    <label for="duree">Durée du concert (en minutes):</label>
                    <input type="number" name="duree" id="duree" value="<?= $objConcert->get("duree") ?>" required>
                </div>
                <div class="w45">
                    <label for="prix">Prix de la prestation (€) :</label>
                    <input type="number" name="prix" id="prix" step="0.01" value="<?= $objConcert->get("prix") ?>" required>
                </div>
                <div class="w100">
                    <label for="region">Région(s) possible(s) :</label>
                    <input type="text" name="region" id="region" value="<?= $objConcert->get("region") ?>" required>
                </div>
                <div class="w100">
                    <label for="type_lieu">Type de lieu nécessaire :</label>
                    <input type="text" name="type_lieu" id="type_lieu" value="<?= $objConcert->get("type_lieu") ?>" required>
                </div>
                <input type="submit" value="Mettre à jour">
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
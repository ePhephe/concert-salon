<?php

/**
 * Template du formulaire de création d'un concert
 * Paramètres :
 *      $idConcert - (Facultatif) Identifiant du concert pour lequel on va organiser une représentation
 *      $arrayConcerts - Liste des concerts possible
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposer une représentation</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Proposer une représentation</h1>
            <!-- Formulaire de création d'une nouvelle représentation -->
            <form action="creer_representation.php" method="post" class="crea-artiste">
                <div class="w45">
                    <label for="date_representation">Date de représentation :</label>
                    <input type="date" name="date_representation" id="date_representation" required>
                </div>
                <div class="w100">
                    <label for="concert">Concert choisi :</label>
                    <select name="concert" id="concert">
                    <?php 
                        foreach ($arrayConcerts as $id => $concert) {
                    ?>
                        <option value="<?= $id ?>" <?= ($id==$idConcert)?"selected":"" ?>>
                            Artiste : <?= $concert->get("artiste")->get("nom_scene") ?> -
                            Style : <?= $concert->get("artiste")->get("type_musique") ?> | 
                            <?= $concert->get("duree") ?> min -
                            <?= $concert->get("prix") ?> €
                        </option>
                    <?php
                        }    
                    ?>
                    </select>
                </div>
                <input type="submit" value="Valider">
            </form>
            <?php
            //Message d'erreur de traitement du formulaire
            if(isset($boolResultat) && $boolResultat === false) {
            ?>
                <div class="erreur">
                    <?= $strErreur ?>
                </div>
            <?php
            }
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
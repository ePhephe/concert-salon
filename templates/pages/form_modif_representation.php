<?php

/**
 * Template du formulaire de modification d'une représentation
 * Paramètres :
 *      $objRepresentation - Objet de la représentation à modifier
 *      $arrayConcerts - Tableau indexé sur l'id des concerts possibles
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une représentation</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Modifier une représentation</h1>
            <form action="modifier_representation.php?idRepresentation=<?= $objRepresentation->id() ?>" method="post" class="crea-artiste">
                <div class="w45">
                    <label for="date_representation">Date de représentation :</label>
                    <input type="date" name="date_representation" id="date_representation" value="<?= $objRepresentation->get("date_representation") ?>" required>
                </div>
                <div class="w100">
                    <label for="concert">Concert choisi :</label>
                    <select name="concert" id="concert">
                    <?php 
                        foreach ($arrayConcerts as $id => $concert) {
                    ?>
                        <option value="<?= $id ?>" <?= ($id===$objRepresentation->get("concert")->id())?"selected":"" ?>>
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
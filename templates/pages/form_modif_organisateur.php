<?php

/**
 * Template du formulaire de modification d'un profil organisateur
 * Paramètres :
 *      $objOrganisateur - Objet de l'organisateur à modifier
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier votre profil organisateur</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Modifier mon profil organisateur</h1>
            <form action="modifier_organisateur.php?idOrganisateur=<?= $objOrganisateur->id() ?>" method="post" class="crea-artiste">
                <div class="w100">
                    <label for="ville_organisateur">Ville :</label>
                    <input type="text" name="ville_organisateur" id="ville_organisateur" value="<?= $objOrganisateur->get("ville_organisateur") ?>" required>
                </div>
                <div class="w100">
                    <label for="description_lieu">Brève description de votre lieu :</label>
                    <input type="text" name="description_lieu" id="description_lieu" value="<?= $objOrganisateur->get("description_lieu") ?>" required>
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
        <?php
            include_once("templates/fragments/alerte_messages.php");
        ?>
    </main>
    <?php
        include_once("templates/fragments/scripts.php");
    ?>
</body>
</html>
<?php

/**
 * Template du formulaire de création d'un profil organisateur
 * Paramètres :
 *      $idCompte - Identifiant du compte auquel attaché le profil
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de votre profil organisateur</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Créer mon profil organisateur</h1>
            <!-- Formulaire de création d'un profil organisateur -->
            <form action="creer_profil_organisateur.php?idCompte=<?= $idCompte ?>" method="post" class="crea-artiste">
                <div class="w100">
                    <label for="ville_organisateur">Votre ville :</label>
                    <input type="text" name="ville_organisateur" id="ville_organisateur" required>
                </div>
                <div class="w100">
                    <label for="description_lieu">Description détaillée du lieu :</label>
                    <textarea name="description_lieu" id="description_lieu" required></textarea>
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
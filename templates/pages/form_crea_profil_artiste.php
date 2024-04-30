<?php

/**
 * Template du formulaire de création d'un profil artiste
 * Paramètres :
 *      $idCompte - Identifiant du compte auquel attaché le profil
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de votre profil artiste</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Créer mon profil artiste</h1>
            <!-- Formulaire de création du profil artiste -->
            <form action="creer_profil_artiste.php?idCompte=<?= $idCompte ?>" method="post" class="crea-artiste">
                <div class="w100">
                    <label for="nom_scene">Nom de scène :</label>
                    <input type="text" name="nom_scene" id="nom_scene" required>
                </div>
                <div class="w100">
                    <label for="presentation">Votre présentation :</label>
                    <textarea name="presentation" id="presentation" required></textarea>
                </div>
                <div class="w100">
                    <label for="description_musique">Brève description de votre musique :</label>
                    <input type="text" name="description_musique" id="description_musique" required>
                </div>
                <div class="w100">
                    <label for="type_musique">Type de musique :</label>
                    <input type="text" name="type_musique" id="type_musique" required>
                </div>
                <input type="submit" value="Valider">
            </form>
            <?php
            //Message d'erreur du traitement du formulaire
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
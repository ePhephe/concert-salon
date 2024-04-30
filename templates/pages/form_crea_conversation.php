<?php

/**
 * Template du formulaire de création d'une nouvelle conversation
 * Paramètres :
 *      $idOrganisateur - Identifiant du profil organisateur qui créé la conversation
 *      $idArtiste - Facultatif, identifiant du profil artiste que l'on veut contacter
 *      $arrayArtistes - Tableau indexé des artites qui peuvent être contactés
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle conversation</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Nouvelle conversation</h1>
            <!-- Formulaire de création d'une conversation -->
            <form action="creer_conversation.php?idOrganisateur=<?= $idOrganisateur ?>" method="post" class="crea-artiste">
                <div class="w100">
                    <label for="artiste">Artiste contacté :</label>
                    <select name="artiste" id="artiste" required>
                        <option value="">Choisissez un artiste</option>
                    <?php foreach ($arrayArtistes as $id => $artiste) {
                    ?>
                        <option value="<?= $artiste->id() ?>" <?= ($idArtiste===$artiste->id())?"selected":"" ?>><?= $artiste->get("nom_scene") ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="w100">
                    <label for="objet">Objet de la conversation :</label>
                    <input type="text" name="objet" id="objet" required>
                </div>
                <div class="w100">
                    <label for="contenu">Contenu du message :</label>
                    <textarea name="contenu" id="contenu" required></textarea>
                </div>
                <input type="submit" value="Créer la conversation">
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
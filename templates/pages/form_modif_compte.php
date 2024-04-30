<?php

/**
 * Template du formulaire de modification d'un compte
 * Paramètres :
 *      $objCompteModif - Objet du compte à modifier
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier votre compte</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Modifier votre compte</h1>
            <form action="modifier_compte.php?idCompte=<?= $objCompteModif->id() ?>" method="post" class="inscription">
                <div class="w45">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" value="<?= $objCompteModif->get("nom_compte") ?>" required>
                </div>
                <div class="w45">
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" value="<?= $objCompteModif->get("prenom_compte") ?>" required>
                </div>
                <div class="w100">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" value="<?= $objCompteModif->get("email") ?>" required>
                </div>
                <div class="w100">
                    <label for="passwordOld">Confirmer votre mot de passe actuel :</label>
                    <input type="password" name="passwordOld" id="passwordOld" required>
                </div>
                <fieldset>
                    <legend>Changement de mot de passe</legend>
                    <div class="w100">
                        <label for="password">Nouveau mot de passe :</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="w100">
                        <label for="passwordConfirm">Confirmation du nouveau mot de passe :</label>
                        <input type="password" name="passwordConfirm" id="passwordConfirm">
                    </div>
                </fieldset>
                <div class="w100">
                    <input type="checkbox" name="notifEmail" id="notifEmail" <?= ($objCompteModif->get("notification_email") === "O") ? "checked" : "" ?>>
                    <label for="notifEmail">Je souhaite être notifier de mes messages par email </label>
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
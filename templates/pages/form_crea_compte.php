<?php

/**
 * Template du formulaire de création d'un compte
 * Paramètres :
 *      Néant
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un compte</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once("templates/fragments/menu.php");
    ?>
    <main>
        <section class="flex justify-center">
            <h1>Inscription à un concert dans mon salon</h1>
            <!-- Formulaire pour la création d'un concert -->
            <form action="creer_compte.php" method="post" class="inscription">
                <div class="w45">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" required>
                </div>
                <div class="w45">
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" required>
                </div>
                <div class="w45">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="w45">
                    <label for="profil">Type de profil :</label>
                    <select name="profil" id="profil" required>
                        <option value="">Choisir un profil</option>
                        <option value="artiste">Artiste</option>
                        <option value="organisateur">Organisateur de concert</option>
                    </select>
                </div>
                <div class="w45">
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="w45">
                    <label for="passwordConfirm">Confirmation du mot de passe :</label>
                    <input type="password" name="passwordConfirm" id="passwordConfirm" required>
                </div>
                <div class="w100">
                    <input type="checkbox" name="notifEmail" id="notifEmail">
                    <label for="notifEmail">Je souhaite être notifier de mes messages par email </label>
                </div>
                <input type="submit" value="M'inscrire">
            </form>
            <?php
            //Bloc d'affichage des erreurs du traitement du formulaire
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
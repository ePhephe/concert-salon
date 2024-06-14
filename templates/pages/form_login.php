<?php

/**
 * Template de la page de connexion
 * Paramètres :
 *      Néant
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion à l'application</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="background-img">

</div>
    <main>
        <section class="connexion flex justify-center align-center">
            <div>
                <h1>Connexion</h1>
                <!-- Formulaire de connexion à l'application -->
                <form action="verifier_connexion.php" method="post" class="login">
                    <label for="login">Email de connexion <span class="required">*</span> : </label>
                    <input type="text" name="login" id="login">
                    <label for="password">Mot de passe <span class="required">*</span> : </label>
                    <input type="password" name="password" id="password">
                    <input type="submit" value="Connexion">
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
            </div>
        </section>
    </main>
</body>
</html>
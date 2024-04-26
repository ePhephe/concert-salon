<?php

/**
 * Template de la page qui liste les concerts
 * Paramètres :
 *      $arrayConcerts - Tableau d'objets concerts indexé sur l'id
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de nos offres de concert</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include_once("templates/fragments/menu.php"); ?>
    <main>
        <section>
            <h1>Liste de nos offres de concert</h1>
        </section>
        <?php if(session_isconnected() && $objCompte->isArtiste() != 0){ ?>
        <nav class="sous-menu">
            <ul>
                <li><a href="afficher_form_crea_concert.php?idArtiste=<?= $objCompte->isArtiste() ?>">Créer un concert</a></li>
            </ul>
        </nav>
        <?php } ?>
        <section>
            <b>Rechercher :</b> 
            <form action="lister_concerts.php" method="post" class="recherche">
                <div>
                    <label for="artiste">Artiste : </label>
                    <select name="artiste" id="artiste">
                        <option value="">Choisir votre artiste</option>
                        <?php
                            foreach ($arrayArtistes as $id => $artiste) {
                        ?>
                            <option value="<?= $id ?>" <?php if(isset($_REQUEST["artiste"])){if($id == $_REQUEST["artiste"]){echo "selected";}}?>> <?= $artiste->get("nom_scene") ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="duree_min">Durée minimum (min) : </label>
                    <input type="number" name="duree_min" id="duree_min" value="<?= (isset($_REQUEST["duree_min"])) ? $_REQUEST["duree_min"] : "" ?>">
                    <label for="duree_max">Durée maximum (min) : </label>
                    <input type="number" name="duree_max" id="duree_max" value="<?= (isset($_REQUEST["duree_max"])) ? $_REQUEST["duree_max"] : "" ?>">
                </div>
                <div>
                    <label for="prix_min">Prix minimum (€) : </label>
                    <input type="number" name="prix_min" id="prix_min" step="0.01" value="<?= (isset($_REQUEST["prix_min"])) ? $_REQUEST["prix_min"] : "" ?>">
                    <label for="prix_max">Prix maximum (€) : </label>
                    <input type="number" name="prix_max" id="prix_max" step="0.01" value="<?= (isset($_REQUEST["prix_max"])) ? $_REQUEST["prix_max"] : "" ?>">
                </div>
                <div>
                    <label for="region">Région : </label>
                    <input type="text" name="region" id="region" value="<?= (isset($_REQUEST["region"])) ? $_REQUEST["region"] : "" ?>">
                </div>
                <input type="submit" value="Filtrer">
            </form>
        </section>
        <section>
            <?php
                include_once("templates/fragments/tableau_concerts.php");
            ?>
        </section>
    </main>
</body>
</html>
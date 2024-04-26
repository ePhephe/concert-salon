<?php

/**
 * Template fragment pour afficher le menu
 * Paramètres :
 *      éléments de la session
 *      $objCompte - Objet du compte connecté (ou non)
 */

?>

<header>
    <nav>
        <ul>
            <li>
                <a href="index.php"><img src="img/home_icon.png" alt=""></a>
            </li>
            <li>
                <a href="lister_artistes.php">Liste des artistes</a>
            </li>
            <li>
                <a href="lister_concerts.php">Liste des concerts</a>
            </li>
            <?php
            //Si l'utilisateur est connecté, on lui affiche les pages de profil et la messagerie (avec le nom de messages non-lus)
            if(session_isconnected()){
            ?>
            <li>
                <a href="lister_representations.php">Liste des représentations</a>
            </li>
            <li>
                <a href="afficher_profil_artiste.php?idCompte=<?= $objCompte->id() ?>">Profil Artiste</a>
            </li>
            <li>
                <a href="afficher_profil_organisateur.php?idCompte=<?= $objCompte->id() ?>">Profil Organisateur</a>
            </li>
            <li>
                <a href="lister_conversations.php">Messagerie <?php if($objCompte->nbMessageNonlu() > 0) { ?><div class="msg-pastille-alerte"><?= $objCompte->nbMessageNonlu() ?></div><?php } ?></a>
            </li>
            <?php
            }
            ?>
        </ul>
    </nav>
    <nav>
        <ul>
            <?php
            //Si l'utilisateur est connecté, on lui affiche l'accès à la modification de son compte
            if(session_isconnected()){
            ?>
            <li>
                <a href="afficher_form_modif_compte.php?idCompte=<?= $objCompte->id() ?>"><img src="img/user_icon.png" alt=""></a>
            </li>
            <?php
            }
            ?>
            <?php
            //Si l'utilisateur est déconnecté, on lui affiche les boutons de connexion et d'inscription
            if(!session_isconnected()){
            ?>
            <li>
                <a class="button" href="afficher_form_login.php">Connexion</a>
            </li>
            <li>
                <a class="button" href="afficher_form_crea_compte.php">Inscription</a>
            </li>
            <?php
            }
            ?>
        </ul>
    </nav>
</header>
<div class="header-fixed">

</div>
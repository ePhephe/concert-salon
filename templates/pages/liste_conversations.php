<?php

/**
 * Template de la page qui liste les conversations
 * Paramètres :
 *      $objCompte - Objet du compte connecté
 *      $arrayConversationsArtiste - Tableau indexé par l'id d'objets conversation où le compte intervient comme artiste
 *      $arrayConversationsOrganisateur - Tableau indexé par l'id d'objets de concerts où le compte intervient comme organisateur
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma messagerie</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include_once("templates/fragments/menu.php"); ?>
    <main>
        <section>
            <h1>Ma messagerie</h1>
        </section>
    <?php if($objCompte->isOrganisateur()!=0) { ?>
        <section>
            <a class="button" href="afficher_form_crea_conversation.php?idOrganisateur=<?= $objCompte->isOrganisateur() ?>">Nouvelle conversation</a>
        </section>
        <section>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>A l'artiste</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Objet</th>
                        <th class="action"></th>
                        <th class="action"></th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($arrayConversationsOrganisateur as $id => $conversation) { ?>
                    <tr>
                        <td><?php if($objCompte->nbMessageNonlu($id) > 0) { ?><div class="msg-pastille-alerte"><?= $objCompte->nbMessageNonlu($id) ?></div><?php } ?></td>
                        <td class="important"><?= $conversation->get("artiste")->get("nom_scene") ?></td>
                        <td><?= date("d/m/Y H:m",strtotime($conversation->get("date_conversation"))) ?></td>
                        <td><?= ($conversation->get("statut_conversation") === "O")? "Ouverte" : "Archivée" ?></td>
                        <td class="important"><?= $conversation->get("objet") ?></td>
                        <td><a href="lister_messages.php?idConversation=<?= $conversation->id() ?>"><img src="img/open_icon.png" alt="Icone ouvrir"></a></td>
                        <?php if($conversation->get("statut_conversation") === "O") { ?>
                        <td><a href="changer_statut_conversation.php?idConversation=<?= $conversation->id() ?>&statut=A"><img src="img/archive_icon.png" alt="Icone archiver"></a></td>
                        <?php }else if($conversation->get("statut_conversation") === "A") { ?>
                        <td><a href="changer_statut_conversation.php?idConversation=<?= $conversation->id() ?>&statut=O"><img src="img/reopen_icon.png" alt="Icone rouvrir"></a></td>
                        <?php } ?>
                    </tr>
            <?php } ?>
                </tbody>
            </table>
        </section>
    <?php } 
    
    if($objCompte->isArtiste()!=0) { ?>
        <section>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>De l'organisateur</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Objet</th>
                        <th class="action"></th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($arrayConversationsArtiste as $id => $conversation) { ?>
                    <tr>
                        <td><?php if($objCompte->nbMessageNonlu($id) > 0) { ?><div class="msg-pastille-alerte"><?= $objCompte->nbMessageNonlu($id) ?></div><?php } ?></td>    
                        <td class="important"><?= $conversation->get("organisateur")->get("compte")->get("nom_compte") ?> <?= $conversation->get("organisateur")->get("compte")->get("prenom_compte") ?></td>
                        <td><?= date("d/m/Y H:m",strtotime($conversation->get("date_conversation"))) ?></td>
                        <td><?= ($conversation->get("statut_conversation") === "O")? "Ouverte" : "Archivée" ?></td>
                        <td class="important"><?= $conversation->get("objet") ?></td>
                        <td><a href="lister_messages.php?idConversation=<?= $conversation->id() ?>"><img src="img/open_icon.png" alt="Icone ouvrir"></a></td>
                    </tr>
            <?php } ?>
                </tbody>
            </table>
        </section>
        <?php
            include_once("templates/fragments/alerte_messages.php");
        ?>
    </main>
    <?php } ?>
    <?php
        include_once("templates/fragments/scripts.php");
    ?>
</body>
</html>
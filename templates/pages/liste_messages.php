<?php

/**
 * Template de la page qui liste des messages d'une conversation
 * Paramètres :
 *      $objCompte - Objet du compte connecté
 *      $arrayMessages - Tableau indexé par l'id d'objets message concernant la conversation
 *      $objConversation - Objet de la conversation
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
    <main class="flex justify-center">
        <section class="w100">
            <h1>Conversation : <?= $objConversation->get("objet") ?></h1>
        </section>
        <section class="action-conversation w100">
    <?php if($objCompte->isOrganisateur()!=0) { ?>
        <?php if($objConversation->get("statut_conversation") === "O") { ?>
            <a class="button"  href="changer_statut_conversation.php?idConversation=<?= $objConversation->id() ?>&statut=A">Archiver</a>
            <?php }else if($objConversation->get("statut_conversation") === "A") { ?>
            <a class="button"  href="changer_statut_conversation.php?idConversation=<?= $objConversation->id() ?>&statut=O">Rouvrir</a>
            <?php } ?>
    <?php } ?>
            <a class="button" href="changer_statut_message.php?idConversation=<?= $objConversation->id() ?>&statut=L">Tout marquer lu</a>
            <a class="button" href="changer_statut_message.php?idConversation=<?= $objConversation->id() ?>&statut=NL">Tout marquer non-lu</a>
        </section>
        <section class="new-message w100">
            <form action="creer_message.php?idConversation=<?= $objConversation->id() ?>" method="post">
                <textarea name="contenu" id="contenu" required></textarea>
                <input type="submit" value="Envoyer un nouveau message">
            </form>
        </section>
        <section class="flex conversation w100">
                <?php foreach ($arrayMessages as $id => $message) { ?>
                    
                    <div class="message <?= ($message->get("compte_destinataire")->id()===$objCompte->id())?"recu":"envoye" ?>" id="message<?= $message->id() ?>">
                        <?php if($message->get("compte_destinataire")->id()===$objCompte->id() && $message->get("statut_message")==="NL") { ?>
                            <div class="msg-pastille-alerte fixed"></div>
                        <?php } ?>
                        <p><?= nl2br($message->get("contenu")) ?></p><br/>
                        <span class="date-message"><?= date("d/m/Y H:m",strtotime($message->get("date_message"))) ?></span>
                        <?php if($message->get("compte_expediteur")->id()!=$objCompte->id()) { ?>
                        - <a href="changer_statut_message.php?idMessage=<?= $message->id() ?>&statut=<?= ($message->get("statut_message")==="L")?"NL":"L" ?>">Lu/Non Lu</a> 
                        <?php } ?>
                    </div>

                <?php } ?>
        </section>
        <div class="message-fixed">

        </div>
</body>
</html>
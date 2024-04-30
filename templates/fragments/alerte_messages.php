<div class="alert-message" id="alertMessage" style="display:none">
    Nouveau(x) message(s) !
    <a href="lister_conversations.php" title="">Aller à la messagerie</a>
</div>

<?php 
    if(isSet($_SESSION["conversation_epinglee"])) {
        $objConversationEpinglee = $_SESSION["conversation_epinglee"];
?>
<div class="conversation-fixed" id="conversationEpinglee">
    <div class="head-conversation" id="headConversation">
    <?= (strlen($objConversationEpinglee->get("objet"))>20)? substr($objConversationEpinglee->get("objet"),0,20) . "..." : $objConversationEpinglee->get("objet") ?> - 
    <?php
        if ($objConversationEpinglee->get("organisateur")->get("compte")->id() === $objCompte->id()){
            echo $objConversationEpinglee->get("artiste")->get("compte")->get("nom_compte"). " " .$objConversationEpinglee->get("artiste")->get("compte")->get("prenom_compte");
        }
        else {
            echo $objConversationEpinglee->get("organisateur")->get("compte")->get("nom_compte"). " " .$objConversationEpinglee->get("organisateur")->get("compte")->get("prenom_compte");
        }
    ?>
    <div class="msg-pastille-alerte" id="pastilleMsgNLConv"><?= $objCompte->nbMessageNonlu($objConversationEpinglee->id()) ?></div>
    </div>
    <div class="body-conversation-box d-none" id="bodyConversationBox">
        <div class="body-conversation" id="bodyConversation">
        </div>
    </div>
    <div class="form-conversation d-none" id="formConversation">
        <form action="creer_message.php?idConversation=<?= $_SESSION["conversation_epinglee"]->id() ?>" method="post" id="formNewMessage">
            <textarea name="contenu" id="contenu"></textarea>
            <input type="submit" value="Envoyer">
        </form>
    </div>
</div>
<?php 
}
?>
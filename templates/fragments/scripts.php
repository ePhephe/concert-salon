<?php
    if(session_isconnected()) {
?>
<script>
    let idCompte = <?= $objCompte->id() ?>;
</script>
<?php
    }
    else {
?>
<script>
    let idCompte = 0;
</script>
<?php
    }
?>
<?php
    if(isSet($_SESSION["conversation_epinglee"])) {
?>
<script>
    let idConversationEpinglee = <?= $_SESSION["conversation_epinglee"]->id() ?>;
</script>
<?php
    }
?>
<script src="js/app.js"></script>
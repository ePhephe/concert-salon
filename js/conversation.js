function getMessages(idConversation){
    //Appel du fichier json pour construire la liste
    fetch(`http://concert.mdurand.mywebecom.ovh/lister_messages_json.php?idConversation=`+idConversation).then(res => {
        return res.json();
    }).then(rep => {
        //On appelle notre fonction d'affichage
        let sectionConversation = document.getElementById(`conversationMessages`);
        let templateHTML = ``;

        rep.forEach(message => {
            templateHTML += `<div class="message ${message.etat}" id="message${message.id}">`;
            if((message.statut === "NL" || message.statut === "N") && message.isExpediteur === "N"){
                templateHTML += `<div class="msg-pastille-alerte fixed"></div>`;
            }
            templateHTML += `<p>${message.contenu}</p><br/>
                <span class="date-message">${message.dateMessage}</span> - `;
            if(message.isExpediteur === "N"){            
                templateHTML += `<a href="changer_statut_message.php?idMessage=${message.id}&statut=`;
                if(message.statut === "NL" || message.statut === "N") {
                    templateHTML += `L`;
                }
                else {
                    templateHTML += `NL`;
                }
                templateHTML += `">Lu/Non Lu</a>`;
            }
            templateHTML += `</div>`;
        });

        sectionConversation.innerHTML = templateHTML;

        console.log(rep);
    }).catch(err => {
        console.log(err);
    });
}

let timerConversation = setInterval(getMessages,1000,idConversation);

//On récupère le formulaire d'envoi d'un nouveau message
let formNewMessage = document.getElementById(`formNewMessage`);

formNewMessage.addEventListener(`submit`,(e)=>{
    //On interrompt le comportement
    e.preventDefault();

    let inputMessage = document.getElementById(`contenu`);

    let data = new FormData();
    data.append("contenu",inputMessage.value);

    //Appel du fichier json pour construire la liste
    fetch(`http://concert.mdurand.mywebecom.ovh/creer_message.php?idConversation=`+idConversation, {method:`POST`,body:data}).then(res => {
        return res.json();
    }).then(rep => {
        inputMessage.value = ``;
        console.log(rep);
    }).catch(err => {
        console.log(err);
    });
});
function messagesNonlus(idCompte){
    //Appel du fichier json pour construire la liste
    fetch(`http://concert.mdurand.mywebecom.ovh/afficher_messages_nonlus.php?idCompte=`+idCompte).then(res => {
        return res.json();
    }).then(rep => {
        //On appelle notre fonction d'affichage
        if(idCompte!=0) {
            let divMessage = document.getElementById(`nouveauMessage`);
            divMessage.innerText = rep.nbMessagesNonlus;
        }
        //console.log(rep);
    }).catch(err => {
        console.log(err);
    });
}

function nouveauxMessages(idCompte){
    //Appel du fichier json pour construire la liste
    fetch(`http://concert.mdurand.mywebecom.ovh/afficher_messages_nouveaux.php?idCompte=`+idCompte).then(res => {
        return res.json();
    }).then(rep => {
        //On appelle notre fonction d'affichage
        if(idCompte!=0) {
            let divMessageAlert = document.getElementById(`alertMessage`);
            if(rep.nbMessagesNouveaux>0) {
                divMessageAlert.style=`display:flex`;
                setTimeout(() => {
                    divMessageAlert.style=`display:none`;
                }, "5000");
            }
        }
        //console.log(rep);
    }).catch(err => {
        console.log(err);
    });
}

let timerMessage = setInterval(messagesNonlus,2000,idCompte);
let timerNewMessage = setInterval(nouveauxMessages,5000,idCompte);

let divConversation = document.getElementById(`headConversation`);
if(divConversation != null) {
    divConversation.addEventListener(`click`,(e)=>{
        let divConversation = document.getElementById(`bodyConversationBox`);
        let formConversation = document.getElementById(`formConversation`);

        divConversation.classList.toggle("d-none");
        formConversation.classList.toggle("d-none");
    });

    function messagesNonlusConv(idCompte,idConversationEpinglee) {
        //Appel du fichier json pour construire la liste
        fetch(`http://concert.mdurand.mywebecom.ovh/afficher_messages_nonlus.php?idCompte=`+idCompte+`&idConversation=`+idConversationEpinglee).then(res => {
            return res.json();
        }).then(rep => {
            //On appelle notre fonction d'affichage
            let divMessageNLConv = document.getElementById(`pastilleMsgNLConv`);
            divMessageNLConv.innerText = rep.nbMessagesNonlus;
            //console.log(rep);
        }).catch(err => {
            console.log(err);
        });
    }

    function listMessagesConv(idConversationEpinglee){
        //Appel du fichier json pour construire la liste
        fetch(`http://concert.mdurand.mywebecom.ovh/lister_messages_json.php?idConversation=`+idConversationEpinglee).then(res => {
            return res.json();
        }).then(rep => {
            //On appelle notre fonction d'affichage
            let sectionConversation = document.getElementById(`bodyConversation`);
            let templateHTML = ``;

            rep.forEach(message => {
                templateHTML += `<div class="message ${message.etat}" id="message${message.id}">`;
                if((message.statut === "NL" || message.statut === "N") && message.isExpediteur === "N"){
                    templateHTML += `<div class="msg-pastille-alerte fixed"></div>`;
                }
                templateHTML += `<p>${message.contenu}</p><br/>
                    <span class="date-message">${message.dateMessage}</span> - `;
                if(message.isExpediteur === "N"){            
                    templateHTML += `<a href="changer_statut_message_json.php?idMessage=${message.id}&statut=`;
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

            let liensMessages = document.querySelectorAll(".body-conversation .message a");
            liensMessages.forEach(lien => { 
                lien.addEventListener(`click`,(e)=>{
                    e.preventDefault();
                    fetch(lien.href).then(res => {
                        return res.json();
                    }).then(rep => {
                        
                    }).catch(err => {
                        console.log(err);
                    });
                });
            });
            //console.log(rep);
        }).catch(err => {
            console.log(err);
        });
    }

    let formConversation = document.getElementById(`formConversation`);

    formConversation.addEventListener(`submit`,(e)=>{
        e.preventDefault();
        let inputMessage = document.getElementById(`contenu`);

        let data = new FormData();
        data.append("contenu",inputMessage.value);

        //Appel du fichier json pour construire la liste
        fetch(`http://concert.mdurand.mywebecom.ovh/creer_message.php?idConversation=`+idConversationEpinglee, {method:`POST`,body:data}).then(res => {
            return res.json();
        }).then(rep => {
            inputMessage.value = ``;
            //console.log(rep);
        }).catch(err => {
            console.log(err);
        });
    });

    let timerNewMessageNL = setInterval(messagesNonlusConv,1000,idCompte,idConversationEpinglee);
    let timerListMessage = setInterval(listMessagesConv,3000,idConversationEpinglee);
}


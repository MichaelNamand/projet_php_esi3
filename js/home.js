let user;
document.addEventListener("DOMContentLoaded", function(event) {
    if (localStorage.getItem('user')) {
        user = JSON.parse(localStorage.getItem('user'));
        const spans = document.getElementsByClassName('header-profile-name');
        for (let i = 0; i < spans.length; i++) {
            spans[i].textContent = user.prenom + ' ' + user.nom;
        }
    } else {
        alert('Hé là ! Vous n\'êtes pas connecté !');
        window.location.href = 'index.html';
    }

    const btns = document.getElementsByClassName('disconnect-btn');
    for (let i = 0; i < btns.length; i++) {
        btns[i].addEventListener('click', () => {
            localStorage.clear();
            window.location.href = 'index.html';
        })
    }

    const dialogDisconnect = document.getElementById('dialog-disconnect');
    if (! dialogDisconnect.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }

    document.getElementById('disconnect').addEventListener('click', () => {
        console.log('here');
        const dialogDisconnect = document.getElementById('dialog-disconnect');
        dialogDisconnect.classList.add('anim-appear');
        dialogDisconnect.classList.remove('anim-disappear');
        dialogDisconnect.showModal();
    });

    dialogDisconnect.querySelector('.close').addEventListener('click', () => {
        dialogDisconnect.classList.remove('anim-appear');
        dialogDisconnect.classList.add('anim-disappear');
        setTimeout(() => {
            dialogQuestionnaire.close();
        }, 401);
    });

    const dialogQuestionnaire = document.getElementById('dialog-questionnaire');

    if (! dialogQuestionnaire.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }

    dialogQuestionnaire.querySelector('.close').addEventListener('click', () => {
        dialogQuestionnaire.classList.remove('anim-appear');
        dialogQuestionnaire.classList.add('anim-disappear');
        reponsesQuestionnaire = [];
        currentQuestion = 0;
        setTimeout(() => {
            dialogQuestionnaire.close();
        }, 401);
    });

    getQuestionnaires();
});
let questionnaires = [];
let currentQuestion = 0;
let bonnesReponsesTotal = 0;
let reponsesQuestionnaire = [];

function getQuestionnaires() {
    console.log('get');
    $.ajax({
        type:'GET',
        url:'./php/home/questionnaires.php',
        success:function(data) {
            console.log(JSON.parse(data));
            questionnaires = JSON.parse(data);
            console.log(JSON.parse(questionnaires[0].questions[0].reponses));
            displayQuestionnaires();
        },
        error : function(error) {
            console.log(error);
            alert('Erreur du serveur. Réessayer plus tard.');
        }
    });
}

function displayQuestionnaires() {
    const table = document.getElementById('table-body');
    table.innerHTML = '';
    if (questionnaires.length > 0) {
        for (let i = 0; i < questionnaires.length; i++) {
            const tr = document.createElement('tr');
            const td1 = document.createElement('td');
            const td2 = document.createElement('td');
            const td3 = document.createElement('td');
            const td4 = document.createElement('td');
            const td5 = document.createElement('td');
            const btn = document.createElement('button');

            td1.textContent = questionnaires[i].idQuestionnaire;
            td2.textContent = questionnaires[i].libelleQuestionnaire;
            questionnaires[i].date_done ? td3.textContent = questionnaires[i].date_done : td3.textContent = '-';
            questionnaires[i].point ? td4.textContent = questionnaires[i].point + ' %' : td4.textContent = '-';

            btn.classList.add('show-dialog-questionnaire', 'mdl-button', 'mdl-js-button', 'mdl-button--raised', 'mdl-button--raised', 'mdl-js-ripple-effect', 'mdl-button--colored');
            btn.textContent = 'Commencer';


            btn.addEventListener('click', () => {
                const dialogQuestionnaire = document.getElementById('dialog-questionnaire');
                dialogQuestionnaire.classList.add('anim-appear');
                dialogQuestionnaire.classList.remove('anim-disappear');
                dialogQuestionnaire.showModal();
                displayAllQuestionnaire(i, questionnaires[i]);
            });

            td2.classList.add('mdl-data-table__cell--non-numeric');
            td3.classList.add('mdl-data-table__cell--non-numeric');
            td5.classList.add('mdl-data-table__cell--non-numeric');

            td5.appendChild(btn);

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);

            table.appendChild(tr);
        }
    } else {
        table.innerHTML = '<h5>Aucun questionnaire n\'est en ligne actuellement...</h5>';
    }

}

function displayAllQuestionnaire(id, questionnaire) {
    const div = document.getElementById('questionnaire');
    div.innerHTML = '<h5>' + questionnaires[id].questions[currentQuestion].libelleQuestion + '</h5>';
    let type = 'checkbox';

    const reponses = JSON.parse(questionnaires[id].questions[currentQuestion].reponses);

    if (questionnaires[id].questions[currentQuestion].nbBonneReponse == 1) {
        for (let i = 0; i < reponses.length; i++) {
            div.innerHTML += '<p><label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="i-' + reponses[i].idReponse + '">' +
                '<input type="radio" id="i-' + reponses[i].idReponse + '" class="mdl-radio__button" name="options" value="' + reponses[i].idReponse + '">' +
                '<span class="mdl-radio__label">'+ reponses[i].valeur+'</span> </label></p>';
        }
    } else {
        for (let i = 0; i < reponses.length; i++) {
            div.innerHTML += '<p><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="i-' + reponses[i].idReponse + '">' +
                '<input type="checkbox" id="i-' + reponses[i].idReponse + '" class="mdl-checkbox__input" name="test" value="' + reponses[i].idReponse + '">' +
                '<span class="mdl-checkbox__label">'+reponses[i].valeur+'</span></label></p>';
        }
    }
    console.log(type);


    const btn = document.createElement('button');
    btn.id = 'check';
    btn.classList.add('mdl-button','mdl-js-button', 'mdl-button--raised', 'mdl-js-ripple-effect');
    btn.addEventListener('click', () => {
        checkAndNext(questionnaires[id].questions[currentQuestion], id)
    });

    if (currentQuestion === questionnaire.questions.length - 1){
        btn.textContent = 'Envoyer le questionnaire';
    } else {
        btn.textContent = 'Valider';
    }

    if (document.getElementById('check')) {
        document.getElementById('check').remove();
    }
    document.getElementById('buttons-questionnaire').appendChild(btn);

    componentHandler.upgradeDom();

}

function checkAndNext(question, id) {
    console.log('here');
    const div = document.getElementById('questionnaire');
    const labels = div.getElementsByTagName('label');
    const questionUser = [];
    if (div.getElementsByClassName('is-checked').length === 0) {
        alert('Vous devez répondre à la question avant de valider !');
    } else {
        questionUser['questionId'] = question.idQuestion;
        questionUser['reponsesId'] = [];
        for (let i = 0; i < labels.length; i++) {
            if (labels[i].classList.contains('is-checked')) {
                questionUser['reponsesId'].push(labels[i].getElementsByTagName('input')[0].value);
            }
        }
        reponsesQuestionnaire.push(questionUser);
        console.log(reponsesQuestionnaire);
        if (currentQuestion >= questionnaires[id].questions.length - 1) {
            finishQuestionnaire(id);
        } else {
            currentQuestion++;
            displayAllQuestionnaire(id, questionnaires[id]);
        }
    }
}

function isGoodAnswer(idQuestionnaire, idQuestion, idReponse) {
    for (let i = 0; i < questionnaires[idQuestionnaire].questions.length; i++) {
        if (questionnaires[idQuestionnaire].questions[i].idQuestion === idQuestion) {
            const reponses = JSON.parse(questionnaires[idQuestionnaire].questions[i].reponses);
            for (let j = 0; j < reponses.length; j++) {
                if (reponses[j].idReponse === idReponse) {
                    if (reponses[j].bonne === '1') {
                        console.log(reponses[j]);
                    }
                    return reponses[j].bonne === '1';
                }
            }
        }
    }
}

function finishQuestionnaire(id) {
    let bonnesReponsesUser = 0;
    getTotalBonnesReponses(id);

    for (let i = 0; i < reponsesQuestionnaire.length; i++) {
        for (let j = 0; j < reponsesQuestionnaire[i].reponsesId.length; j++) {
            if (isGoodAnswer(id, reponsesQuestionnaire[i].questionId, reponsesQuestionnaire[i].reponsesId[j])){
                bonnesReponsesUser++;
            }
        }
    }
    const dialogQuestionnaire = document.getElementById('dialog-questionnaire');
    dialogQuestionnaire.querySelector('.close').click();
    const pReussite = parseFloat((bonnesReponsesUser / bonnesReponsesTotal) * 100).toFixed(0);
    let message = 'Vous avez terminé le questionnaire. Votre pourcentage total de réponses justes est de ' + pReussite + '%.';
    if (pReussite === 0) {
        message += 'Dommage, vous aurez peut-être une réponse juste la prochaine fois !';

    }else if (pReussite < 50) {
        message += ' Peut mieux faire !';
    } else if (pReussite > 50) {
        message += ' Excellent résultat ! Nous sommes sûrs que vous pouvez faire mieux ;-)'
    } else {
        message += ' Félicitation ! Vous avez répondu juste à toutes les questions !';
    }
    document.getElementById('results').textContent = message;
    const dialogFinish = document.getElementById('dialog-finish');
    dialogFinish.classList.add('anim-appear');
    dialogFinish.classList.remove('anim-disappear');
    dialogFinish.showModal();
    dialogFinish.querySelector('.close').addEventListener('click', () => {
        dialogFinish.classList.remove('anim-appear');
        dialogFinish.classList.add('anim-disappear');
        setTimeout(() => {
            dialogFinish.close();
        }, 401);
    });
    var today  = new Date();
    $.ajax({
        type:'POST',
        url:'./php/home/sendQuestionnaire.php',
        data: 'idEtudiant='+user.idEtudiant + '&idQuestionnaire=' + questionnaires[id].idQuestionnaire + '&dateFait=' + today.toLocaleDateString("fr-FR") + '&point=' + pReussite,
        success:function(data) {
            console.log(data);
            getQuestionnaires();
        },
        error : function(error) {
            console.log(error);
            alert('Erreur du serveur. Réessayer plus tard.');
        }
    });
}

function getTotalBonnesReponses(idQuestionnaire) {
    bonnesReponsesTotal = 0;
    for (let i = 0; i < questionnaires[idQuestionnaire].questions.length; i++) {
        const reponses = JSON.parse(questionnaires[idQuestionnaire].questions[i].reponses);
        for (let j = 0; j < reponses.length; j++) {
            if (reponses[j].bonne === '1') {
                bonnesReponsesTotal++;
            }
        }
    }
    return bonnesReponsesTotal;
}
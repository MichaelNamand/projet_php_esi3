<html>
    <head>
        <meta charset="utf-8">
        <title>Questionnaire</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
        <link rel="stylesheet" href="assets/css/index.css">
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    </head>
    <body>
    <?php
    require ('connexion.php');
    ?>

    <div class="welcome-page">
        <div class="demo-card-wide mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Projet QCM</h2>
            </div>
            <div class="mdl-card__supporting-text">
                Bienvenue dans ce questionnaire en ligne créé par Michael Namand. Pour commencer, cliquez.. sur Commencer ! Vous aurez besoin d'un identifiant et d'un code confidentiel pour continuer. Si vous n'en possédez pas, inscrivez-vous
                <a href="#" id="show-dialog-register">ici</a> !
            </div>
            <div class="mdl-card__actions mdl-card--border" style="text-align: right">
                <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="show-dialog-connexion">
                    Commencer
                </a>
            </div>
        </div>
    </div>

    <dialog class="mdl-dialog" style="width: 500px; top: 50%; transform: translateY(-50%);" id="dialog-connexion">
        <h4 class="mdl-dialog__title">Connexion</h4>
        <form action="home.php">
        <div class="mdl-dialog__content">

                <div class="mdl-textfield mdl-js-textfield" id="div-id">
                    <input class="mdl-textfield__input" type="text" id="id" required>
                    <label class="mdl-textfield__label" for="id">Identifiant</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield" id="div-pass">
                    <input class="mdl-textfield__input" type="password" id="pass" pattern="-?[0-9]*(\.[0-9]+)?" required>
                    <label class="mdl-textfield__label" for="pass">Code confidentiel</label>
                    <span class="mdl-textfield__error">Veuillez entrer seulement des chiffres !</span>
                </div>
                <img class="login-img" src="assets/images/login.png">
        </div>
        <div class="mdl-dialog__actions">
            <button type="submit" class="mdl-button" id="connexion">Connexion</button>
            <button type="button" class="mdl-button close">Annuler</button>
        </div>
        </form>
    </dialog>

    <dialog class="mdl-dialog" style="width: 500px; top: 50%; transform: translateY(-50%);" id="dialog-register">
        <h4 class="mdl-dialog__title">Inscription</h4>
        <form action="connexion.php">
            <div class="mdl-dialog__content">

                <div class="mdl-textfield mdl-js-textfield" id="div-register-id">
                    <input class="mdl-textfield__input" type="text" id="register-id" required>
                    <label class="mdl-textfield__label" for="register-id">Nom d'utilisateur</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield" id="div-register-pass">
                    <input class="mdl-textfield__input" type="password" id="register-pass" pattern="-?[0-9]*(\.[0-9]+)?" required>
                    <label class="mdl-textfield__label" for="pass">Code confidentiel</label>
                    <span class="mdl-textfield__error">Veuillez entrer seulement des chiffres !</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield" id="div-register-lname">
                    <input class="mdl-textfield__input" type="text" id="register-lname" required>
                    <label class="mdl-textfield__label" for="register-lname">Nom</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield" id="div-register-fname">
                    <input class="mdl-textfield__input" type="text" id="register-fname" required>
                    <label class="mdl-textfield__label" for="register-fname">Prénom</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield" id="div-register-mail">
                    <input class="mdl-textfield__input" type="email" id="register-mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                    <label class="mdl-textfield__label" for="register-mail">Email</label>
                    <span class="mdl-textfield__error">Email non valide !</span>
                </div>
                <img class="login-img" src="assets/images/welcome.png">
            </div>
            <div class="mdl-dialog__actions">
                <button type="submit" class="mdl-button" id="register">S'inscrire !</button>
                <button type="button" class="mdl-button close">Annuler</button>
            </div>
        </form>
    </dialog>
    </body>
    <script>
        // gestion connexion dialog
        const dialog = document.getElementById('dialog-connexion');
        const showDialogButton = document.querySelector('#show-dialog-connexion');
        if (! dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }
        showDialogButton.addEventListener('click', function() {
            dialog.classList.add('anim-appear');
            dialog.classList.remove('anim-disappear');
            document.getElementById('div-id').classList.remove('is-invalid');
            document.getElementById('div-pass').classList.remove('is-invalid');
            dialog.showModal();
        });
        dialog.querySelector('.close').addEventListener('click', function() {
            dialog.classList.remove('anim-appear');
            dialog.classList.add('anim-disappear');
            setTimeout(() => {
                dialog.close();
            }, 401);
        });

        // gestion register dialog
        const dialogRegister = document.getElementById('dialog-register');
        const showDialogRegisterButton = document.querySelector('#show-dialog-register');
        if (! dialogRegister.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }
        showDialogRegisterButton.addEventListener('click', function() {
            dialogRegister.classList.add('anim-appear');
            dialogRegister.classList.remove('anim-disappear');
            let tf = dialogRegister.getElementsByClassName('mdl-textfield');
            console.log(tf);
            for (let i = 0; i < tf.length; i++) {
                tf[i].classList.remove('is-invalid');
            }
            document.getElementById('div-pass').classList.remove('is-invalid');
            dialogRegister.showModal();
        });
        dialogRegister.querySelector('.close').addEventListener('click', function() {
            dialogRegister.classList.remove('anim-appear');
            dialogRegister.classList.add('anim-disappear');
            setTimeout(() => {
                dialogRegister.close();
            }, 401);
        });
    </script>
</html>
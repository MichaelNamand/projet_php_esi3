// gestion connexion dialog
document.addEventListener("DOMContentLoaded", function(event) {
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

});

function login () {

    let data = {
        username: document.getElementById('id').value,
        password: document.getElementById('pass').value
    };
    console.log(data);
    $.ajax({
        type:'POST',
        url:'./php/index/login.php',
        data: 'username='+data.username + '&password=' + data.password,
        success:function(data) {
            const result =(JSON.parse(data));
            console.log(result);
            if (result === 'error') {
                alert('Identifiant ou mot de passe incorrect !')
            } else {
                localStorage.setItem('user', JSON.stringify(result));
                const dialog = document.getElementById('dialog-connexion');
                dialog.classList.remove('anim-appear');
                dialog.classList.add('anim-disappear');
                document.body.style.opacity = '0';
                setTimeout(() => {
                    dialog.close();
                    window.location.href = "home.html";
                }, 350);

            }
        },
        error : function(error) {
            console.log(error);
            alert('Erreur du serveur. Réessayer plus tard.');
        }
    });
}

function registers() {
    let data = {
        username: document.getElementById('register-id').value,
        password: document.getElementById('register-pass').value,
        fname: document.getElementById('register-fname').value,
        lname: document.getElementById('register-lname').value,
        email: document.getElementById('register-mail').value,
    };
    $.ajax({
        type:'POST',
        url:'./php/index/register.php',
        data: 'username-register='+data.username + '&password-register=' + data.password +
            '&fname-register=' + data.fname + '&lname-register=' + data.lname + '&email-register=' + data.email,
        success:function(data) {
            if (data.status === 'error') {
                alert('Une erreur est survenue... Réessayez plus tard.')
            } else {
                alert(data);
                window.location.href = "index.html";
            }
        },
        error : function(error) {
            console.log(error);
            alert('Erreur du serveur. Réessayer plus tard.');
        }
    });
    console.log(data);
}

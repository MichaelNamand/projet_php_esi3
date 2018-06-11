document.addEventListener("DOMContentLoaded", function(event) {
    document.body.style.opacity = '1';
    let user;
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
});

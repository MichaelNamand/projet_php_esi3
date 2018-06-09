<html>
    <head>
        <head>
            <meta charset="utf-8">
            <title>Questionnaire</title>
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
            <link rel="stylesheet" href="assets/css/home.css">
            <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        </head>
    </head>
    <body>
        <!-- Always shows a header, even in smaller screens. -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                    <!-- Title -->
                    <span class="mdl-layout-title">Projet QCM - Powered by Michael Namand</span>
                    <!-- Add spacer, to align navigation to the right -->
                    <div class="mdl-layout-spacer"></div>
                    <!-- Navigation. We hide it in small screens. -->
                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <img class="login-img" src="assets/images/user.svg"> Michael Namand
                        <a class="mdl-navigation__link" href="index.php">Déconnexion</a>
                    </nav>
                </div>
            </header>
            <div class="mdl-layout__drawer">
                <span class="mdl-layout-title">Option</span>
                <nav class="mdl-navigation">
                    <a class="mdl-navigation__link" href=""><img class="" src="assets/images/user.svg"> Michael Namand</a>
                    <a class="mdl-navigation__link" href="">Déconnexion</a>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <div class="page-content">
                    <h4 class="mdl-dialog__title" style="text-align: center">Choisissez votre questionnaire</h4>
                    <div class="mdl-dialog__content">
                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width: 100%; margin: auto; max-width: 750px;">
                            <thead>
                            <tr>
                                <th>Numéro</th>
                                <th  class="mdl-data-table__cell--non-numeric">Libellé</th>
                                <th class="mdl-data-table__cell--non-numeric">Fait le</th>
                                <th class="mdl-data-table__cell--non-numeric">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Acrylic (Transparent)</td>
                                <td  class="mdl-data-table__cell--non-numeric">25</td>
                                <td class="mdl-data-table__cell--non-numeric">$2.90</td>
                                <td class="mdl-data-table__cell--non-numeric">$2.90</td>
                            </tr>
                            <tr>
                                <td>Plywood (Birch)</td>
                                <td  class="mdl-data-table__cell--non-numeric">50</td>
                                <td  class="mdl-data-table__cell--non-numeric">$1.25</td>
                                <td  class="mdl-data-table__cell--non-numeric">$1.25</td>
                            </tr>
                            <tr>
                                <td>Laminate (Gold on Blue)</td>
                                <td  class="mdl-data-table__cell--non-numeric">10</td>
                                <td  class="mdl-data-table__cell--non-numeric">$2.35</td>
                                <td  class="mdl-data-table__cell--non-numeric">$2.35</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

        <script>
            var dialog = document.querySelector('dialog');
            dialog.showModal();
            var showDialogButton = document.querySelector('#show-dialog');
            if (! dialog.showModal) {
                dialogPolyfill.registerDialog(dialog);
            }
            showDialogButton.addEventListener('click', function() {
                dialog.showModal();
            });
            dialog.querySelector('.close').addEventListener('click', function() {
                dialog.close();
            });
        </script>
    </body>
</html>
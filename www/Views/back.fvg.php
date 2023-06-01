<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Administration WebTrunk</title>
        <meta name="description" content="Administration WebTrunk">
        <link rel="stylesheet" href="../public/css/back.css">
        <link rel="icon" href="../public/assets/favicon-white.png">
    </head>
    <body>
        <header class="back-header">
            <object data="../public/assets/webtrunk-w-icon.svg"></object>
        </header>
        <aside>
            Prénom Nom<br>
            Déconnexion
            <nav class="back-menu">
                <a class="menu-link" href="dashboard">
                    Dashboard
                </a>
                <a class="menu-link" href="pages">
                    Pages
                </a>
                <a class="menu-link" href="articles">
                    Articles
                </a>
                <a class="menu-link" href="medias">
                    Médias
                </a>
                <a class="menu-link" href="moderation">
                    Modération
                </a>
                <a class="menu-link" href="users">
                    Utilisateurs
                </a>
                <a class="menu-link" href="settings">
                    Paramètres
                </a>
            </nav>
            <footer>
                Tâches rapides
                <button>
                    Créer un nouvel article
                </button>
                <button>
                    Planifier une maintenance
                </button>
                Informations du site
                <section>
                    État du site: En ligne
                    Prochaine maintenance prévue: <br>Aucune
                </section>
            </footer>
        </aside>

        <main>
            <?php include $this->view;?>
        </main>
    </body>
</html>
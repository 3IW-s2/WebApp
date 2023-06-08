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
        <div class="layout-container">
            <aside class="back-menu">
                <div class="user-info">
                <span class="user-info--name">
                   Prénom Nom
                </span>
                    <span class="user-info--disconnect">
                    Déconnexion
                </span>
                </div>
                <div class="back-menu-navigation-container">
                    <nav class="back-menu-navigation">
                        <div class="menu-link-container">
                            <a class="menu-link" href="dashboard">
                                Dashboard
                            </a>
                        </div>

                        <div class="menu-link-container">
                            <a class="menu-link" href="pages">
                                Pages
                            </a>
                        </div>

                        <div class="menu-link-container">
                            <a class="menu-link" href="articles">
                                Articles
                            </a>
                        </div>

                        <div class="menu-link-container">
                            <a class="menu-link" href="medias">
                                Médias
                            </a>
                        </div>

                        <div class="menu-link-container">
                            <a class="menu-link" href="moderation">
                                Modération
                            </a>
                        </div>

                        <div class="menu-link-container">
                            <a class="menu-link" href="users">
                                Utilisateurs
                            </a>
                        </div>

                        <div class="menu-link-container">
                            <a class="menu-link" href="settings">
                                Paramètres
                            </a>
                        </div>
                    </nav>



                    <div class="back-bottom-menu-navigation">
                        <div>
                            <div class="section-delimiter">
                    <span class="section-delimiter--text">
                        Tâches rapides
                    </span>
                                <span class="section-delimiter--hr"></span>
                            </div>
                            <div class="quick-actions-container">
                                <div class="quick-actions">
                        <span class="quick-actions--text">
                            Créer un nouvel article
                        </span>
                                    <svg class="quick-actions--icon" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48">
                                        <path d="M140 936q-24.75 0-42.375-17.625T80 876V216l67 67 66-67 67 67 67-67 66 67 67-67 67 67 66-67 67 67 67-67 66 67 67-67v660q0 24.75-17.625 42.375T820 936H140Zm0-60h310V596H140v280Zm370 0h310V766H510v110Zm0-170h310V596H510v110ZM140 536h680V416H140v120Z"/>
                                    </svg>
                                </div>
                                <div class="quick-actions">
                        <span class="quick-actions--text">
                            Planifier une maintenance
                        </span>
                                    <svg class="quick-actions--icon" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 96 960 960" width="48">
                                        <path d="m381 838-43-43 100-99-100-99 43-43 99 100 99-100 43 43-100 99 100 99-43 43-99-100-99 100ZM180 976q-24 0-42-18t-18-42V296q0-24 18-42t42-18h65v-60h65v60h340v-60h65v60h65q24 0 42 18t18 42v620q0 24-18 42t-42 18H180Zm0-60h600V486H180v430Zm0-490h600V296H180v130Zm0 0V296v130Z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="section-delimiter">
                        <span class="section-delimiter--text">
                            Informations du site
                        </span>
                                <span class="section-delimiter--hr"></span>
                            </div>
                            <section class="site-state">
                    <span class="site-state--infos">
                        État du site: En ligne
                    </span>
                                <span class="site-state--infos">
                        Prochaine maintenance prévue: Aucune
                    </span>

                            </section>
                        </div>
                    </div>

                </div>

            </aside>
            <main>
                <?php include $this->view;?>
            </main>
        </div>
    </body>
</html>
import InstallerForm from "../components/InstallerForm.js";

export default class setupDatabaseConfirmation extends InstallerForm{

    constructor() {
        super({
            title: "Installation de la base de données confirmée",
            description: "Cliquer sur le bouton ci-dessous pour continuer l'installation.",
            backLink: {
                class: "installer-button",
                title: "Étape précédente",
                link: "/db-setup",
            },

            nextLink: {
                class: "installer-button",
                title: "Étape suivante",
                link: "/app-setup",
            }
        });
    }
}
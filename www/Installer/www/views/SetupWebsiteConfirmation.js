import InstallerForm from "../components/InstallerForm.js";

export default class setupWebsiteConfirmation extends InstallerForm{

    constructor() {
        super({
            title: "Installation du site confirmée",
            description: "Cliquer sur \"Me connecter\" pour finaliser l'installation",
            backLink: {
                class: "installer-button",
                title: "Étape précédente",
                link: "/app-setup",
            },

            nextLink: {
                class: "installer-button",
                title: "Me connecter",
                link: "/login",
            }
        });
    }
}
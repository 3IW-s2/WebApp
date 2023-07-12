import InstallerForm from "../components/InstallerForm.js";

export default class NotFound extends InstallerForm{

    constructor() {
        super({
            title: "On est où là ? (404)",
            description: "Gros coup dur là",
            nextLink: {
                class: "installer-button",
                title: "Retour à l'installation",
                link: "/",
            }
        });
    }
}

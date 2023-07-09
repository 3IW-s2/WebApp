import Input from "../components/Input.js";
import InstallerForm from "../components/InstallerForm.js";

export default class SetupDatabase extends InstallerForm{

    constructor() {
        super({
            title: "Installation de la base de données",
            description: "Les informations suivantes sont nécessaires pour configurer la base de données.",
            inputs: [
                new Input({
                    label: "Nom de la base de données",
                    type: "text",
                    name: "databaseName",
                    placeholder: "Nom de la base de données",
                    required: true,
                }, true),

                new Input({
                    label: "Nom d'utilisateur de la base de données",
                    type: "text",
                    name: "databaseUsername",
                    placeholder: "Nom d'utilisateur de la base de données",
                    required: true,
                }, true),

                new Input({
                    label: "Mot de passe de la base de données",
                    type: "password",
                    name: "databasePassword",
                    placeholder: "Mot de passe de la base de données",
                    required: true,
                }, true),

                new Input({
                    label: "Hôte de la base de données",
                    type: "text",
                    name: "databaseHost",
                    placeholder: "Hôte de la base de données",
                    required: true,
                }, true),

                new Input({
                    label: "Port de la base de données",
                    type: "text",
                    name: "databasePort",
                    placeholder: "Port de la base de données",
                    required: true,
                }, true),

                new Input({
                    label: "Préfixe des tables",
                    type: "text",
                    name: "databasePrefix",
                    placeholder: "Préfixe des tables",
                    required: true,
                }, true),
            ],
            backLink: {
                class: "installer-button",
                title: "Étape précédente",
                link: "/",
            },

            nextLink: {
                class: "installer-button",
                title: "Étape suivante",
                link: "/db-confirmation",
            }
        });
    }
}
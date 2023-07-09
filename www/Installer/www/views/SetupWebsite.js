import InstallerForm from "../components/InstallerForm.js";
import Input from "../components/Input.js";

export default class SetupWebsite extends InstallerForm{
    constructor() {
        super({
            title: "Initialisation de l'application",
            description: "Les informations suivantes sont nécessaires pour configurer l'application.",
            inputs: [
                new Input({
                    label: "Nom de l'application",
                    type: "text",
                    name: "appName",
                    placeholder: "Nom de l'application",
                    required: true,
                }, true),

                new Input({
                    label: "Adresse email",
                    type: "email",
                    name: "email",
                    placeholder: "Adresse email",
                    required: true,
                }, true),
                new Input({
                    label: "Nom",
                    type: "text",
                    name: "name",
                    placeholder: "Nom",
                    required: true,
                }, true),
                new Input({
                    label: "Prénom",
                    type: "text",
                    name: "lastname",
                    placeholder: "Prénom",
                    required: true,
                }, true),
                new Input({
                    label: "Mot de passe",
                    type: "password",
                    name: "password",
                    placeholder: "Mot de passe",
                    required: true,
                }, true),
                new Input({
                    label: "Confirmation du mot de passe",
                    type: "password",
                    name: "passwordConfirmation",
                    placeholder: "Confirmation du mot de passe",
                    required: true,
                }, true)
            ],
            backLink: {
                class: "installer-button",
                title: "Étape précédente",
                link: "/db-confirmation",
            },
            nextLink: {
                class: "installer-button",
                title: "Étape suivante",
                link: "/app-confirmation",
            }
        });
    }
}
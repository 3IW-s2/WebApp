import InstallerForm from "../components/InstallerForm.js";
import Input from "../components/Input.js";
import Link from "../components/Link.js";

export default class SetupWebsite extends InstallerForm{
    constructor() {
        super({
            title: "Initialisation de l'application",
            description: "Les informations suivantes sont nécessaires pour configurer l'application. Les informations peuvent être pré-remplies dans le cas suivant : vous revenez à cette étape après avoir cliqué sur le bouton \"Étape précédente\".",
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
                    name: "lastname",
                    placeholder: "Nom",
                    required: true,
                }, true),
                new Input({
                    label: "Prénom",
                    type: "text",
                    name: "firstname",
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

            nextLink: new Link({
                class: "installer-button",
                title: "Me connecter",
                link: "/login",
                click: {
                    handler: (event) => {
                        event.preventDefault();

                        this.inputs.forEach(input => {
                            const inputDom = document.querySelector(`[data-identifier='${input.identifier}']`).querySelector("input");
                            localStorage.setItem(inputDom.name, inputDom.value);
                        });

                        const inputsObject = {};
                        document.querySelectorAll(".form-container--content input").forEach(input => {
                            inputsObject[input.name] = input.value;
                        });

                        const messageContainer = document.getElementById("error-message");
                        messageContainer.style.display = "flex";
                        messageContainer.style.alignItems = "center";
                        const loadingGif = document.createElement("img");
                        loadingGif.src = "/Installer/www/public/icons/waiting.gif";
                        loadingGif.style.width = "20px";
                        messageContainer.innerHTML = "Initialisation de l'application en cours...";
                        messageContainer.prepend(loadingGif);
                        fetch("/api/user", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: new URLSearchParams(inputsObject).toString()

                        }).then(response => response.json()).then(data => {
                            if(!data.success){
                                messageContainer.innerHTML = data.message;
                            }else{
                                window.location.href = "/login";
                            }
                        });
                    }
                }
            }),

            actionDescription: "En cliquant sur \"Étape suivante\", la base de données sera initialisée et le site sera configuré.",
        });
    }
}
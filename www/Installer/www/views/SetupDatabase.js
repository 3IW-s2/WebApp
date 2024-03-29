import Input from "../components/Input.js";
import InstallerForm from "../components/InstallerForm.js";
import Link from "../components/Link.js";

export default class SetupDatabase extends InstallerForm {
    constructor() {
        super({
            // Appelle le constructeur de la classe parente InstallerForm avec les paramètres spécifiés
            title: "Configuration de la base de données",
            description: "Les informations suivantes sont nécessaires pour configurer la base de données. Les informations peuvent être pré-remplies dans le cas suivant : vous revenez à cette étape après avoir cliqué sur le bouton \"Étape précédente\".",
            inputs: [
                // Crée une instance de la classe Input pour chaque champ de saisie requis
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
                // Définit le lien "Étape précédente" pour revenir à l'étape précédente
                class: "installer-button",
                title: "Étape précédente",
                link: "/",
            },

            nextLink: new Link({
                // Définit le lien "Étape suivante" pour passer à l'étape suivante
                class: "installer-button",
                title: "Étape suivante",
                link: "/db-confirmation",
                click: {
                    handler: (event) => {
                        event.preventDefault();

                        this.inputs.forEach(input => {
                            // Sauvegarde les valeurs des champs de saisie dans le stockage local
                            const inputDom = document.querySelector(`[data-identifier='${input.identifier}']`).querySelector("input");
                            localStorage.setItem(inputDom.name, inputDom.value);
                        });

                        const inputsObject = {};
                        document.querySelectorAll(".form-container--content input").forEach(input => {
                            // Récupère les valeurs des champs de saisie et les stocke dans un objet
                            inputsObject[input.name] = input.value;
                        });

                        
                        const messageContainer = document.getElementById("error-message");
                        messageContainer.style.display = "flex";
                        messageContainer.style.alignItems = "center";
                        const loadingGif = document.createElement("img");
                        loadingGif.src = "/Installer/www/public/icons/waiting.gif";
                        loadingGif.style.width = "20px";
                        messageContainer.innerHTML = "Tentative de connexion à la base de données et initialisation des tables...";
                        messageContainer.prepend(loadingGif);

                        // Envoie une requête POST à l'API pour configurer la base de données
                        fetch("/api/database", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded",
                            },
                            body: new URLSearchParams(inputsObject).toString()

                        }).then(response => response.json()).then(data => {
                            if (!data.success) {
                                // Affiche un message d'erreur si la configuration de la base de données échoue
                                messageContainer.innerHTML = data.message;
                            } else {
                                // Redirige vers la page de confirmation si la configuration de la base de données réussit
                                history.pushState({}, undefined, "/db-confirmation");
                            }
                        });
                    }
                }
            })
        });
    }
}

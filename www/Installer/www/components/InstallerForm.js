// Importe la classe Component depuis le fichier Component.js
import Component from "./Component.js";
// Importe la classe Link depuis le fichier Link.js
import Link from "./Link.js";

// Définit la classe InstallerForm qui étend la classe Component
export default class InstallerForm extends Component {
    constructor(props) {
        // Appelle le constructeur de la classe parente Component avec les props passés en paramètre
        super(props);

        // Initialise les propriétés de l'instance avec les valeurs des props ou des valeurs par défaut
        this.title = props.title ?? "Formulaire";
        this.description = props.description ?? "Description";
        this.inputs = props.inputs ?? [];

        this.actionDescription = props.actionDescription ?? "";

        // backLink n'est pas obligatoire, peut être null
        this.backLink = props.backLink ?? null;

        this.nextLink = props.nextLink ?? null;
    }

    render() {
        return {
            // Structure du rendu de l'élément racine
            type: "div",
            children: [
                {
                    type: "div",
                    children: [
                        {
                            type: "div",
                            children: [
                                {
                                    type: "h1",
                                    children: [this.title],
                                },
                                {
                                    type: "p",
                                    children: [this.description],
                                },
                                {
                                    type: "div",
                                    children: [
                                        // Rendu des éléments d'entrée à partir des données dans this.inputs
                                        ...this.inputs.map(input => input.render()),
                                    ],
                                    attributes: {
                                        class: "flex-column form-container--content"
                                    }
                                },
                            ],
                            attributes: {
                                class: "flex-column"
                            }
                        },
                        {
                            type: "p",
                            children: [this.actionDescription],
                            attributes: {
                                id: "action-description"
                            }
                        },
                        {
                            type: "p",
                            children: [],
                            attributes: {
                                id: "error-message"
                            }
                        },
                        {
                            type: "div",
                            children: [
                                // Vérifie si backLink est différent de null, si oui, rend un objet Link à partir des données dans this.backLink
                                this.backLink !== null ? new Link({
                                    class: this.backLink.class,
                                    title: this.backLink.title,
                                    link: this.backLink.link,
                                    click: {
                                        handler: (event) => {
                                            // Enregistre les valeurs des éléments d'entrée dans le stockage local (localStorage)
                                            this.inputs.forEach(input => {
                                                const inputDom = document.querySelector(`[data-identifier='${input.identifier}']`).querySelector("input");
                                                localStorage.setItem(inputDom.name, inputDom.value);
                                            });

                                            event.preventDefault();
                                            // Navigue vers le lien de retour en utilisant l'historique du navigateur
                                            history.pushState({}, undefined, this.backLink.link);
                                        }
                                    }
                                }).render() : "",
                                // Vérifie si nextLink est une instance de Component, si oui, appelle render() directement, sinon rend un objet Link à partir des données dans this.nextLink
                                this.nextLink instanceof Component
                                    ? this.nextLink.render()
                                    : new Link({
                                        class: this.nextLink.class,
                                        title: this.nextLink.title,
                                        link: this.nextLink.link,
                                        click: {
                                            handler: (event) => {
                                                event.preventDefault();
                                                
                                                // Enregistre les valeurs des éléments d'entrée dans le stockage local (localStorage)
                                                this.inputs.forEach(input => {
                                                    const inputDom = document.querySelector(`[data-identifier='${input.identifier}']`).querySelector("input");
                                                    localStorage.setItem(inputDom.name, inputDom.value);
                                                });

                                                // Navigue vers le lien suivant en utilisant l'historique du navigateur
                                                history.pushState({}, undefined, this.nextLink.link);
                                            }
                                        }
                                    }).render(),
                            ],
                            attributes: {
                                class: "installer-button-container"
                            }
                        },
                    ],
                    attributes: {
                        class: "flex-column form-container"
                    },
                }
            ],
            attributes: {
                id: "page-container",
            }
        }
    }
}

// Importe la classe Component depuis le fichier Component.js
import Component from "./Component.js";

// Définit la classe Input qui étend la classe Component
export default class Input extends Component {
    constructor(props, checkLocalStorage = false) {
        // Appelle le constructeur de la classe parente Component avec les props passés en paramètre
        super(props);

        // Assigner la valeur du paramètre checkLocalStorage à la propriété checkLocalStorage de l'instance Input
        this.checkLocalStorage = checkLocalStorage;
    }

    render() {
        // Déstructuration des propriétés spécifiées dans this.props avec des valeurs par défaut
        const {
            label = "Label",
            type = "text",
            name = "name",
            value = this.checkLocalStorage ? (localStorage.getItem(name) ?? "") : "",
            placeholder = "",
            style = {},
        } = this.props;

        return {
            // Structure du rendu de l'élément d'entrée
            type: "div",
            children: [
                {
                    type: "label",
                    children: [label],
                    attributes: {
                        for: name,
                    }
                },
                {
                    type: "input",
                    attributes: {
                        type: type,
                        name: name,
                        value: value,
                        placeholder: placeholder,
                        style: style,
                    },
                }
            ],
            attributes: {
                // Ajout des attributs par défaut de la classe Component
                ...this.defaultAttributes,
                class: "flex-column input-container",
            }
        }
    }
}

import generateStructure from "../core/DomRenderer.js";
import StructureGenerator from "../core/DomRenderer.js";

export default class Component {
    constructor(props) {
        // Initialise les propriétés et l'état du composant
        this.props = props;
        this.state = {};
        this.oldState = null;

        // Génère un identifiant unique pour le composant
        this.identifier = this.generateId();
        this.defaultAttributes = {
            "data-identifier": this.identifier,
        }
    }

    shouldUpdate() {
        if (!this.oldState) {
            return true; // Le composant n'a jamais été rendu --> MàJ
        }

        // On compare les anciens/nouveaux états
        const stateKeys = Object.keys(this.state);
        const oldStateKeys = Object.keys(this.oldState);

        // Si taille différente --> MàJ
        if (stateKeys.length !== oldStateKeys.length) {
            return true;
        }

        for (let i = 0; i < stateKeys.length; i++) {
            const key = stateKeys[i];

            if (this.state[key] !== this.oldState[key]) {
                return true; // Un des états a changé --> MàJ
            }
        }

        return false; // Aucun changement --> Pas de MàJ
    }

    update() {
        if (!this.shouldUpdate()) return;

        // Vérifie si un élément input a le focus avant la mise à jour
        const focusedInput = document.activeElement.tagName.toLowerCase() === "input"
            ? document.activeElement
            : null;

        // Génère la nouvelle structure DOM à partir du rendu du composant
        const newDomNode = new StructureGenerator(this.render()).generate();
        const oldNode = document.querySelector(`[data-identifier="${this.identifier}"]`);

        // Remplace l'ancien nœud par le nouveau dans le DOM
        oldNode.replaceWith(newDomNode);

        // Restaure le focus sur l'élément input après la mise à jour
        if (focusedInput) {
            const restoredInput = document.querySelector(`[data-identifier="${this.identifier}"] input`);
            if (restoredInput) {
                restoredInput.focus();
                // TODO: Problème si plusieurs inputs ?
                if ('selectionStart' in focusedInput) {
                    restoredInput.selectionStart = focusedInput.selectionStart;
                    restoredInput.selectionEnd = focusedInput.selectionEnd;
                }
            }
        }
    }

    setState(newState) {
        this.oldState = this.state; // On sauvegarde l'ancien état dans oldState
        this.state = Object.assign({}, this.state, newState);

        if (this.shouldUpdate()) {
            this.update(); // Met à jour le composant si l'état a changé
        }
    }

    render() {
        throw new Error(`Missing render() method in ${this.constructor.name} class`);
    }

    generateId() {
        // Génère un identifiant unique pour le composant
        const identifiers = Array.from(document.querySelectorAll("[data-identifier]")).map((element) => element.dataset.identifier);
        const identifier = Math.random().toString(36).slice(2, 11);
        if (identifiers.includes(identifier)) {
            return generateId(); // Rappel récursif si l'identifiant est déjà utilisé
        }
        return identifier;
    }
}

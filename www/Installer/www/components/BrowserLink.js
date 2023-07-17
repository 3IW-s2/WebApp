import Link from "./Link.js";

// Définit la classe BrowserLink qui étend la classe Link
class BrowserLink extends Link {

    constructor(props) {
        // Appelle le constructeur de la classe parente Link avec les props passés en paramètre
        super(props);
    }

    render() {
        // Déstructuration des propriétés spécifiées dans this.props avec des valeurs par défaut
        const {
            title = "Lien",
            link = {},
        } = this.props;

        // Retourne un nouvel objet Link avec les propriétés spécifiées, et rendu à l'aide de la méthode render()
        return new Link({
            class: this.props.class ?? "", // Propriété class avec la valeur de this.props.class ou une chaîne vide si non définie
            title: title,
            link: link,
            click: {
                handler: (event) => {
                    event.preventDefault(); // Empêche le comportement par défaut du lien
                    history.pushState({}, undefined, link); // Modifie l'URL dans l'historique du navigateur
                }
            },
        }).render();
    }
}

export default BrowserLink;

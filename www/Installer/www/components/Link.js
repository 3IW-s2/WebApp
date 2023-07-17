// Importe la classe Component depuis le fichier Component.js
import Component from "./Component.js";

// Définit la classe Link qui étend la classe Component
export default class Link extends Component {
  constructor(props) {
    // Appelle le constructeur de la classe parente Component avec les props passés en paramètre
    super(props);
  }

  render() {
    // Déstructuration des propriétés spécifiées dans this.props avec des valeurs par défaut
    const {
      title = "Lien",
      link = {},
      click = {}
    } = this.props;

    const style = {
      // Définition des styles pour le lien (commentés dans l'exemple)
      // color: "black",
      // textDecoration: "none",
    };

    return {
      // Structure du rendu de l'élément lien (<a>)
      type: "a",
      attributes: {
        // Attributs de l'élément lien
        href: link,
        style: style,
        class: "link" + (this.props.class ? " " + this.props.class : ""),
        ...this.defaultAttributes,
        "data-active": link === window.location.pathname,
      },
      events: {
        // Événement click
        click
      },
      children: [title],
    };
  }
}

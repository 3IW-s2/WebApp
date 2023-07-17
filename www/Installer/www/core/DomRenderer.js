export default class StructureGenerator {
  constructor(structure) {
    // Initialise l'instance avec la structure à générer
    this.structure = structure;
    this.element = document.createElement(this.structure.type);
  }

  applyAttributes() {
    if (this.structure.attributes) {
      // Parcourt les attributs de la structure
      for (let attrName in this.structure.attributes) {
        if (attrName.startsWith("data-")) {
          // Si l'attribut commence par "data-", l'ajoute en tant que propriété du dataset de l'élément
          this.element.dataset[attrName.replace("data-", "")] = this.structure.attributes[attrName];
        } else if (attrName === "style") {
          // Si l'attribut est "style", fusionne les styles avec ceux de l'élément
          Object.assign(this.element.style, this.structure.attributes[attrName]);
        } else {
          // Sinon, ajoute l'attribut à l'élément
          this.element.setAttribute(attrName, this.structure.attributes[attrName]);
        }
      }
    }
  }

  attachEvents() {
    if (this.structure.events) {
      // Parcourt les événements de la structure
      for (let eventName in this.structure.events) {
        if (Object.keys(this.structure.events[eventName]).length === 0) {
          // Si aucun gestionnaire n'est défini pour l'événement, affiche un message d'erreur
          console.log("No handler for event " + eventName);
          continue;
        }
        // Ajoute l'écouteur d'événement avec le gestionnaire et les options définis
        this.element.addEventListener(eventName, this.structure.events[eventName].handler, this.structure.events[eventName].options);
      }
    }
  }

  appendChildren() {
    if (this.structure.children) {
      // Parcourt les enfants de la structure
      for (let child of this.structure.children) {
        let subChild;
        if (typeof child === "string") {
          // Si l'enfant est une chaîne de caractères, crée un nœud de texte correspondant
          subChild = document.createTextNode(child);
        } else {
          // Sinon, génère un nouveau générateur de structure pour l'enfant et génère l'élément correspondant
          const childGenerator = new StructureGenerator(child);
          subChild = childGenerator.generate();
        }
        // Ajoute l'enfant à l'élément parent
        this.element.appendChild(subChild);
      }
    }
  }

  generate() {
    // Génère la structure en appliquant les attributs, les événements et les enfants à l'élément
    this.applyAttributes();
    this.attachEvents();
    this.appendChildren();
    return this.element;
  }
}

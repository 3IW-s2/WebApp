export default class StructureGenerator {
  constructor(structure) {
    this.structure = structure;
    this.element = document.createElement(this.structure.type);
  }

  applyAttributes() {
    if (this.structure.attributes) {
      for (let attrName in this.structure.attributes) {
        if (attrName.startsWith("data-")) {
          this.element.dataset[attrName.replace("data-", "")] = this.structure.attributes[attrName];
        } else if (attrName === "style") {
          Object.assign(this.element.style, this.structure.attributes[attrName]);
        } else this.element.setAttribute(attrName, this.structure.attributes[attrName]);
      }
    }
  }

  attachEvents() {
    if (this.structure.events) {
      for (let eventName in this.structure.events) {
        if (Object.keys(this.structure.events[eventName]).length === 0) {
          console.log("No handler for event " + eventName);
          continue;
        }
        this.element.addEventListener(eventName, this.structure.events[eventName].handler, this.structure.events[eventName].options);
      }
    }
  }

  appendChildren() {
    if (this.structure.children) {
      for (let child of this.structure.children) {
        let subChild;
        if (typeof child === "string") {
          subChild = document.createTextNode(child);
        } else {
          const childGenerator = new StructureGenerator(child);
          subChild = childGenerator.generate();
        }
        this.element.appendChild(subChild);
      }
    }
  }

  generate() {
    this.applyAttributes();
    this.attachEvents();
    this.appendChildren();
    return this.element;
  }
}


import DomRenderer from "../core/DomRenderer.js";
import StructureGenerator from "../core/DomRenderer.js";

export default class BrowserRouter {
  constructor(routes, rootElement, baseUrl = "") {
    // Initialise les propriétés de la classe
    this.routes = routes;
    this.rootElement = rootElement;
    this.routerBasePath = baseUrl;
    this.init();
  }

  init() {
    // Obtient le chemin d'accès de l'URL actuelle en supprimant la partie de base de l'URL du routeur
    let pathname = location.pathname.replace(this.routerBasePath, "");
    if (!(Object.keys(this.routes).includes(pathname))) {
      // Si le chemin d'accès n'est pas trouvé dans les routes, utilise le chemin d'accès "/404"
      pathname = "/404";
    }

    // Récupère l'instance de la page correspondante au chemin d'accès et génère le rendu de la page
    const page = new this.routes[pathname]().render();
    this.rootElement.appendChild(new StructureGenerator(page).generate());

    // Redéfinit la méthode pushState de l'historique du navigateur pour déclencher un événement "popstate"
    const oldPushState = history.pushState;
    history.pushState = function (data, unused, url) {
      oldPushState.call(history, data, unused, url);
      window.dispatchEvent(new Event("popstate"));
    };

    // Écoute l'événement "popstate" déclenché lorsque l'utilisateur navigue dans l'historique du navigateur
    window.addEventListener("popstate", () => {
      // Obtient le nouveau chemin d'accès de l'URL actuelle
      let pathname = location.pathname.replace(this.routerBasePath, "");
      if (!(Object.keys(this.routes).includes(pathname))) {
        // Si le chemin d'accès n'est pas trouvé dans les routes, utilise le chemin d'accès "/404"
        pathname = "/404";
      }

      // Récupère l'instance de la page correspondante au nouveau chemin d'accès et génère le rendu de la page
      const page = new this.routes[pathname]().render();
      this.rootElement.replaceChild(
          new StructureGenerator(page).generate(),
          this.rootElement.childNodes[0]
      );
    });
  }
}

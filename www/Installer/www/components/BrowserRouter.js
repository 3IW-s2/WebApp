import DomRenderer from "../core/DomRenderer.js";
import StructureGenerator from "../core/DomRenderer.js";

export default class BrowserRouter {
  constructor(routes, rootElement, baseUrl = "") {
    this.routes = routes;
    this.rootElement = rootElement;
    this.routerBasePath = baseUrl;
    this.init();
  }

  init() {
    let pathname = location.pathname.replace(this.routerBasePath, "");
    if (!(Object.keys(this.routes).includes(pathname))) {
      pathname = "/404";
    }

    const page = new this.routes[pathname]().render();
    this.rootElement.appendChild(new StructureGenerator(page).generate());

    const oldPushState = history.pushState;
    history.pushState = function (data, unused, url) {
      oldPushState.call(history, data, unused, url);
      window.dispatchEvent(new Event("popstate"));
    };

    window.addEventListener("popstate", () => {
      let pathname = location.pathname.replace(this.routerBasePath, "");
      if (!(Object.keys(this.routes).includes(pathname))) {
        pathname = "/404";
      }

      const page = new this.routes[pathname]().render();
      this.rootElement.replaceChild(
          new StructureGenerator(page).generate(),
          this.rootElement.childNodes[0]
      );
    });
  }
}

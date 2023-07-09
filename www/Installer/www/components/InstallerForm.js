import Component from "./Component.js";
import Link from "./Link.js";

export default class InstallerForm extends Component{
    constructor(props) {
        super(props);

        this.title = props.title ?? "Formulaire";
        this.description = props.description ?? "Description";
        this.inputs = props.inputs ?? [];

        // backLink isn't required
        this.backLink = props.backLink ?? null;

        this.nextLink = {
            class: props.nextLink?.class ?? "",
            title: props.nextLink?.title ?? "Suivant",
            link: props.nextLink?.link ?? null,
        }
    }

    render() {
        return {
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
                                        ...this.inputs.map(input => input.render()),
                                    ],
                                    attributes: {
                                        class: "flex-column form-container--content"
                                    }
                                },
                            ]
                        },
                        {
                            type: "div",
                            children: [
                                this.backLink !== null ? new Link({
                                    class: this.backLink.class,
                                    title: this.backLink.title,
                                    link: this.backLink.link,
                                    click: {
                                        handler: (event) => {
                                            this.inputs.forEach(input => {
                                                const inputDom = document.querySelector(`[data-identifier='${input.identifier}']`).querySelector("input");
                                                localStorage.setItem(inputDom.name, inputDom.value);
                                            });

                                            event.preventDefault();
                                            history.pushState({}, undefined, this.backLink.link);
                                        }
                                    }
                                }).render() : "",
                                new Link({
                                    class: this.nextLink.class,
                                    title: this.nextLink.title,
                                    link: this.nextLink.link,
                                    click: {
                                        handler: (event) => {
                                            this.inputs.forEach(input => {
                                                const inputDom = document.querySelector(`[data-identifier='${input.identifier}']`).querySelector("input");
                                                localStorage.setItem(inputDom.name, inputDom.value);
                                            });

                                            event.preventDefault();
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
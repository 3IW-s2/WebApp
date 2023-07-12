import Component from "./Component.js";

export default class Input extends Component {
    constructor(props, checkLocalStorage = false) {
        super(props);

        this.checkLocalStorage = checkLocalStorage;
    }

    render() {
        const {
            label = "Label",
            type = "text",
            name = "name",
            value = this.checkLocalStorage ? (localStorage.getItem(name) ?? "") : "",
            placeholder = "",
            style = {},
        } = this.props;

        return {
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
                ...this.defaultAttributes,
                class: "flex-column input-container",
            }
        }
    }
}
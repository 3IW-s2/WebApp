import Link from "./Link.js";

class BrowserLink extends Link {

    constructor(props) {
        super(props);
    }

    render() {
        const {
            title = "Lien",
            link = {},
        } = this.props;

        return new Link({
            class: this.props.class ?? "",
            title: title,
            link: link,
            click: {
                handler: (event) => {
                    event.preventDefault();
                    history.pushState({}, undefined, link);
                }
            },
        }).render();
    }
}

export default BrowserLink;

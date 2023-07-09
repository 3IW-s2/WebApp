import Component from "./Component.js";

export default class Link extends Component {

  constructor(props) {
    super(props);
  }

  render() {
    const {
      title = "Lien",
      link = {},
      click = {}
    } = this.props;

    const style = {
      // color: "black",
      // textDecoration: "none",
    };

    return {
      type: "a",
      attributes: {
        href: link,
        style: style,
        class: "link" + (this.props.class ? " " + this.props.class : ""),
        ...this.defaultAttributes,
        "data-active": link === window.location.pathname,
      },
      events: {
        click
      },
      children: [title],
    };
  }
}

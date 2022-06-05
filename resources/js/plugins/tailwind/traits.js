/* eslint-disable import/no-anonymous-default-export */
const config = require("../../../../tailwind.config");
const theme = require("tailwindcss/resolveConfig")(config).theme;
export default (editor, config = {}) => {
    const tm = editor.TraitManager;

    tm.addType("class_select", {
        events: {
            change: "onChange",
        },
        createInput({ trait }) {
            const md = this.model;
            const opts = md.get("options") || [];
            const input = document.createElement("select");

            const target_view_el = this.target.view.el;

            for (let i = 0; i < opts.length; i++) {
                const option = document.createElement("option");
                let value = opts[i].value;
                if (value === "") {
                    value = "text-black";
                }
                option.text = opts[i].name;
                option.value = value;

                const css = Array.from(target_view_el.classList);

                const value_a = value.split(" ");
                const intersection = css.filter((x) => value_a.includes(x));

                if (intersection.length === value_a.length) {
                    option.setAttribute("selected", "selected");
                }

                input.append(option);
            }
            return input;
        },
        onUpdate({ elInput, component }) {
            const classes = component.getClasses();
            const opts = this.model.get("options") || [];
            opts.length ||
                opts.map((opt) => {
                    let value = opt.value;
                    if (value && classes.includes(value)) {
                        elInput.value = value;
                        return;
                    }
                });

            elInput.value = "text-black";
        },

        onEvent({ elInput, component, event }) {
            const classes = this.model.get("options").map((opt) => opt.value);
            classes.map((className) => {
                component.removeClass(className);
            });
            const value = this.model.get("value");
            const elAttributes = component.attributes.attributes;
            delete elAttributes[""];
            if (value.length > 0 && value !== "text-black") {
                component.addClass(value);
            }
            component.em.trigger("component:toggled");
        },
    });
};

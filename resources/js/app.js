require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import tooltip from "./plugins/tooltip/tooltip";
import "./plugins/tooltip/tooltip.css";
import TraitSelect from "@/jetstream/TraitSelect";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        el.removeAttribute("data-page");
        const application = createApp({ render: () => h(app, props) })
            .directive("tooltip", tooltip)
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);

        return application;
    },
});


InertiaProgress.init({ color: "#fff" });

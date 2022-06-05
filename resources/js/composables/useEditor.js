import grapesjs from "grapesjs";
import { loadBlocks } from "../lib/blocks";
import { deviceButtons, devices, panelButtons } from "../lib/config";
import { appendCss } from "../lib/css";
import resetClasess from "./resetClasess";
import tailwindComponent from "../plugins/tailwind";
export default function useEditor(opts) {
    const editor = grapesjs.init({
        container: opts.el,
        fromElement: true,
        width: "100%",
        height: null,
        storageManager: false,
        deviceManager: { devices },
        blockManager: { appendTo: opts.blocks },
        layerManager: { appendTo: opts.layers },
        traitManager: { appendTo: opts.traits },
        plugins: [tailwindComponent],
        pluginsOpts: {
            tailwindComponent: {},
        },
        panels: {
            defaults: [
                { id: "layersccsc" },
                {
                    id: "panel-devices",
                    el: ".panel__devices",
                    buttons: deviceButtons,
                },
            ],
        },
    });
    editor.Panels.addPanel({
        id: "basic-actions",
        el: opts.panels,
        buttons: panelButtons,
    });

    // editor.BlockManager.add("test blok", {
    //     label: "blok",
    //     resetId: true,
    //     attributes: { class: "" },
    //     content: '<div class=""><h1>hugo</h1></div>',
    //     // category: { label: s.category, open: s.category === "Blog" },
    // });

    loadBlocks(editor);
    appendCss(editor);
    resetClasess(editor);
    editor.on("component:selected", (component) => {
        const domElement = component.getEl();
        console.log(domElement);
    });

    return { editor };
}

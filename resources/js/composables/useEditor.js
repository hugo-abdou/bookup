import grapesjs from "grapesjs";
import { loadBlocks } from "../lib/blocks";
import { deviceButtons, devices, panelButtons } from "../lib/config";
import { appendCss } from "../lib/css";
export default function useEditor(opts) {
    const editor = grapesjs.init({
        container: opts.el,
        fromElement: true,
        height: null,
        width: "100%",
        storageManager: false,
        deviceManager: { devices },
        blockManager: { appendTo: opts.blocks },
        layerManager: { appendTo: opts.layers },
        traitManager: { appendTo: opts.traits },

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

    editor.BlockManager.add("nameee", {
        label: "name",
        attributes: { class: "" },
        content: `<section>
        <h1>This is a simple title</h1>
        <div>This is just a Lorem text: Lorem ipsum dolor sit amet</div>
      </section>`,
        category: { label: "new", open: false },
    });

    loadBlocks(editor);
    appendCss(editor);

    return { editor };
}

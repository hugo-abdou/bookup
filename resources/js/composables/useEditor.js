import grapesjs from "grapesjs";
import { deviceButtons, devices, panelButtons } from "../builder/config";

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

    editor.BlockManager.add("section-me", {
        id: "section",
        label: " <img src='/assets/heroes.png' />",
        attributes: { class: "gjs-block-section" },
        content: `<section>
                        <h1>This is a simple title</h1>
                        <div>

                        <div>This is just a Lorem text: Lorem ipsum dolor sit amet</div>
                        <div>This is just a Lorem text: Lorem ipsum dolor sit amet</div>
                            <span>hugo</span>
                        </div>
                        <div>This is just a Lorem text: Lorem ipsum dolor sit amet</div>
                    </section>`,
    });
    editor.Panels.addPanel({
        id: "basic-actions",
        el: opts.panels,
        buttons: panelButtons,
    });

    return { editor };
}

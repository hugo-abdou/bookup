import { DeviceMobileIcon } from "@heroicons/vue/outline";
export const devices = [
    {
        name: "sm",
        width: "320px", // this value will be used on canvas width
        widthMedia: "320px", // this value will be used in CSS @media
    },
    {
        name: "md",
        width: "768px", // this value will be used on canvas width
        widthMedia: "768px", // this value will be used in CSS @media
    },
    {
        name: "lg",
        width: "", // this value will be used on canvas width
        widthMedia: "", // this value will be used in CSS @media
    },
];
export const deviceButtons = [
    {
        id: "device-sm",
        label: `<img src="/assets/mobile.svg"></img>`,
        command: (editor) => editor.setDevice("sm"),
        togglable: true,
    },
    {
        id: "device-md",
        label: `<img src="/assets/tablet.svg"></img>`,
        command: (editor) => editor.setDevice("md"),
        togglable: false,
    },
    {
        id: "device-lg",
        label: `<img src="/assets/desktop.svg"></img>`,
        command: (editor) => editor.setDevice("lg"),
        togglable: false,
    },
];
export const panelButtons = [
    {
        id: "visibility",
        active: false, // active by default
        className: "btn-toggle-borders",
        label: "<u>B</u>",
        command: "sw-visibility", // Built-in command
    },
    // {
    //     id: "export",
    //     className: "btn-open-export",
    //     label: "Exp",
    //     command: "export-template",
    //     context: "export-template", // For grouping context of buttons from the same panel
    // },
    // {
    //     id: "show-json",
    //     className: "btn-show-json",
    //     label: "JSON",
    //     context: "show-json",
    //     command(editor) {
    //         editor.Modal.setTitle("Components JSON")
    //             .setContent(
    //                 `<textarea style="width:100%; height: 250px;">${JSON.stringify(
    //                     editor.getComponents()
    //                 )}</textarea>`
    //             )
    //             .open();
    //     },
    // },
];

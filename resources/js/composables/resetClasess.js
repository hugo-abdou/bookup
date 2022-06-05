export default function (editor) {
    editor.on(`component:mount`, (model) => {
        model.attributes.classes.map((className) => {
            className.attributes.name = className.attributes.label;
        });
    });
}

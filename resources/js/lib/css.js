export function appendCss(newEditor) {
    const iframe = newEditor.Canvas.getFrameEl();

    if (!iframe) return;

    const cssLink = document.createElement("link");
    cssLink.href = "https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css";
    cssLink.rel = "stylesheet";

    const cssStyle = document.createElement("style");
    cssStyle.innerHTML = `img.object-cover { filter: sepia(1) hue-rotate(190deg) opacity(.46) grayscale(.7) !important; }`;

    // checks iframe is ready before loading Tailwind CSS - issue with firefox
    const f = setInterval(() => {
        const doc = iframe.contentDocument;
        if (doc.readyState === "complete") {
            doc.head.appendChild(cssLink);
            doc.head.appendChild(cssStyle);
            clearInterval(f);
        }
    }, 100);
}

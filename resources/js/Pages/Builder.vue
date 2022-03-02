<template>
    <div class="min-h-screen bg-gray-500">
        <div class="flex justify-between w-full bg-white border-b">
            <div ref="panels"></div>
            <div class="panel__devices"></div>
        </div>
        <div ref="gjs" class="h-[calc(100vh-41px)] shadow-lg">
            <h1>Hello World Component!</h1>
        </div>

        <BuilderSidebarAction buttonClass="right-4" sidebarClass="-right-2">
            <template #button>
                <TemplateIcon class="w-5 h-5" />
            </template>
            <template #sidebar>
                <div ref="blocks"></div>
            </template>
        </BuilderSidebarAction>

        <BuilderSidebarAction buttonClass="right-14" sidebarClass="-right-12 p-0">
            <template #button>
                <ViewBoardsIcon class="w-5 h-5 rotate-90" />
            </template>
            <template #sidebar>
                <div ref="layers"></div>
            </template>
        </BuilderSidebarAction>
        <BuilderSidebarAction buttonClass="right-24" sidebarClass="-right-20 p-0">
            <template #button>
                <PencilIcon class="w-5 h-5 rotate-90" />
            </template>
            <template #sidebar>
                <div ref="traits"></div>
            </template>
        </BuilderSidebarAction>
    </div>
</template>
<script>
import { onMounted, ref } from "vue";
import useEditor from "../composables/useEditor";
import Actions from "../Jetstream/Actions.vue";
import Button from "@/Jetstream/Button.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
import { TemplateIcon, ViewBoardsIcon,PencilIcon } from "@heroicons/vue/outline";
import BuilderSidebarAction from "../Jetstream/BuilderSidebarAction.vue";
const scrollClasses =
    "scrollbar-thumb-gray-300 scrollbar-track-gray-50 scrollbar-thin scrollbar-thumb-rounded-full";

export default {
     components: {
        Actions,
        Button,
        TemplateIcon,
        JetDropdown,
        Popover,
        PopoverButton,
        PopoverPanel,
        ViewBoardsIcon,
        BuilderSidebarAction,PencilIcon
    },
    setup(props) {
        const gjs = ref(null);
        const blocks = ref(null);
        const layerManager = ref(null);
        const panels = ref(null);
        const layers = ref(null);
        const traits = ref(null)

        onMounted(() => {
            const { editor } = useEditor({
                el: gjs.value,
                blocks: blocks.value,
                layerManager: layerManager.value,
                panels: panels.value,
                layers: layers.value,
                traits: traits.value
            });
        });
        return {
            gjs,
            blocks,
            layerManager,
            panels,
            scrollClasses,
            layers,
            Button,
            SecondaryButton,traits
        };
    },

};
</script>
<style>
@import "grapesjs/dist/css/grapes.min.css";

.gjs-pn-panel {
    position: initial;
}
#gjs {
    @apply border-none;
}
.gjs-frame-wrapper {
    @apply shadow-md border;
}
.gjs-layer {
    @apply bg-red-300;
}
.gjs-layer-title-c.gjs-one-bg {
    @apply bg-blue-100;
}
.gjs-cv-canvas {
    @apply top-0 h-full w-full;
}
.gjs-two-color {
    @apply text-gray-700;
}
.gjs-one-bg {
    @apply bg-white;
}
.gjs-blocks-c {
    @apply inline;
}
.gjs-block {
    @apply w-auto;
}
</style>

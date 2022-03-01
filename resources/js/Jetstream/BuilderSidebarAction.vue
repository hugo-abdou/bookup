<template>
    <Popover v-slot="{ open }" class="fixed z-50 bottom-5" :class="buttonClass">
        <PopoverButton as="template">
            <component
                :is="open ? Button : SecondaryButton"
                class="!p-1.5 rounded-full"
                :class="open ? '' : 'text-gray-600'"
            >
                <slot name="button" />
            </component>
        </PopoverButton>
        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0 translate-x-52"
            enter-to-class="translate-x-0 opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="translate-x-0 opacity-100"
            leave-to-class="opacity-0 translate-x-52"
        >
            <PopoverPanel
                :static="true"
                v-show="open"
                class="absolute translate-x-0 bg-white border rounded-lg shadow-md min-w-[200px] overflow-auto bottom-11 -top-[calc(100vh-100px)] p-1"
                :class="[scrollClasses, sidebarClass]"
            >
                <slot name="sidebar" />
            </PopoverPanel>
        </transition>
    </Popover>
</template>
<script>
import Button from "@/Jetstream/Button.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
const scrollClasses =
    "scrollbar-thumb-gray-300 scrollbar-track-gray-50 scrollbar-thin scrollbar-thumb-rounded-full";
export default {
    components: { Popover, PopoverButton, PopoverPanel },
    props: ["buttonClass", "sidebarClass"],
    setup(props) {
        return { scrollClasses, Button, SecondaryButton };
    },
};
</script>

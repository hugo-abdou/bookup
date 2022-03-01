<template>
    <div class="fixed z-50 bottom-16 right-5">
        <jet-button @click="open = !open" class="!rounded-full !p-3 relative z-50">
            <PlusIcon v-if="open" class="w-5 h-5 duration-200 rotate-45" />
            <DotsHorizontalIcon v-else class="w-5 h-5 duration-200" />
        </jet-button>

        <div
            class="absolute top-0 ml-1 duration-300 transform"
            :style="{
                '--tw-translate-y': open ? `-${47 * (i + 1)}px` : '0',
            }"
            v-for="(el, i) in $slots.default()"
            :key="i"
        >
            <component class="!rounded-full !p-2" :is="el" />
        </div>
    </div>
</template>

<script>
import JetButton from "@/Jetstream/Button.vue";
import { DotsHorizontalIcon, PlusIcon } from "@heroicons/vue/outline";
import SecondaryButton from "./SecondaryButton.vue";
import { ref, h } from "vue";

export default {
    components: {
        JetButton,
        DotsHorizontalIcon,
        SecondaryButton,
        PlusIcon,
    },
    setup(props, context) {
        const open = ref(false);

        return { open };
    },
};
</script>

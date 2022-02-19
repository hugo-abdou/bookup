<template>
    <div class="mt-5 md:mt-0">
        <div
            class="px-4 py-5 space-y-2 shadow sm:p-6 bg-lv-2 sm:rounded-lg"
        >
            <jet-section-title>
                <template #title>
                    <slot name="title"></slot>
                </template>
                <template #description>
                    <slot name="description"></slot>
                </template>
            </jet-section-title>

            <slot name="content"></slot>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetSectionTitle from "./SectionTitle.vue";

export default defineComponent({
    components: {
        JetSectionTitle,
    },
});
</script>

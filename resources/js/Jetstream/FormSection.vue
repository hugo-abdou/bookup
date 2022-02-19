<template>
    <div class="mt-5 overflow-hidden duration-200 border shadow md:mt-0 sm:rounded-md dark:border-gray-700">
        <form @submit.prevent="$emit('submitted')">
            <div
                class="px-4 py-5 space-y-5 bg-lv-2 sm:p-6"
            >
                <jet-section-title>
                    <template #title>
                        <slot name="title"></slot>
                    </template>
                    <template #description>
                        <slot name="description"></slot>
                    </template>
                </jet-section-title>
                <div class="grid grid-cols-6 gap-6">
                    <slot name="form"></slot>
                </div>
            </div>

            <div
                class="flex items-center justify-end px-4 py-3 text-right bg-lv-3 sm:px-6"
                v-if="hasActions"
            >
                <slot name="actions"></slot>
            </div>
        </form>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import JetSectionTitle from "./SectionTitle.vue";

export default defineComponent({
    emits: ["submitted"],

    components: {
        JetSectionTitle,
    },

    computed: {
        hasActions() {
            return !!this.$slots.actions;
        },
    },
});
</script>

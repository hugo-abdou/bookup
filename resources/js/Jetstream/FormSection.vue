<template>
    <div class="mt-5 md:mt-0">
        <form @submit.prevent="$emit('submitted')">
            <div
                class="px-4 py-5 bg-white dark:bg-gray-800 duration-200 sm:p-6 shadow space-y-5"
                :class="
                    hasActions
                        ? 'sm:rounded-tl-md sm:rounded-tr-md'
                        : 'sm:rounded-md'
                "
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
                class="flex items-center justify-end px-4 py-3 bg-gray-50 duration-200 dark:bg-gray-700 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
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

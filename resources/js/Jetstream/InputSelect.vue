<template>
    <select
        :class="[
            'border-gray-300 focus:border-teal-300 w-full focus:ring-0 rounded-md shadow-sm dark:text-gray-300 bg-lv-3 bg-opacity-10',
            error && '!border-red-600 !bg-red-600/20 ',
        ]"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    >
        <slot />
    </select>
</template>
<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ["modelValue", "error"],

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
});
</script>

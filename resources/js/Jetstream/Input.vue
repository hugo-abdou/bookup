<template>
    <input
        :class="[
            'border-gray-300 focus:border-teal-300 focus:ring-0 rounded-md shadow-sm dark:text-gray-300 bg-white bg-opacity-10',
            error && '!border-red-600 !bg-red-600/20',
        ]"
        placeholder="...."
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
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

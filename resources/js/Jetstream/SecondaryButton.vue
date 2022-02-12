<template>
    <button
        :type="type"
        class="block py-2 px-4 rounded-md shadow-md active:shadow-sm bg-white hover:bg-gray-100 font-medium border border-gray-300 outline-none"
    >
        <slot></slot>
    </button>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        type: {
            type: String,
            default: "button",
        },
    },
});
</script>

<template>
    <modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="px-6 py-4">
            <div class="text-lg text-lv-1">
                <slot name="title"> </slot>
            </div>

            <div class="mt-4 text-lv-2">
                <slot name="content"> </slot>
            </div>
        </div>

        <div
            class="flex flex-row justify-end px-6 py-4 text-right bg-lv-3"
        >
            <slot name="footer"> </slot>
        </div>
    </modal>
</template>

<script>
import { defineComponent } from "vue";
import Modal from "./Modal.vue";

export default defineComponent({
    emits: ["close"],

    components: {
        Modal,
    },

    props: {
        show: {
            default: false,
        },
        maxWidth: {
            default: "2xl",
        },
        closeable: {
            default: true,
        },
    },

    methods: {
        close() {
            this.$emit("close");
        },
    },
});
</script>

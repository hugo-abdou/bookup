<template>
    <div>
        <transition
            leave-active-class="transition duration-1000 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-show="on" class="text-sm text-lv-3">
                <slot />
            </div>
        </transition>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ["on"],
});
</script>

<template>
    <div>
        <button
            :class="classes"
            class="w-full text-left"
            v-if="$props.as == 'button'"
        >
            <slot></slot>
        </button>

        <Link :href="href" :class="classes" v-else>
            <slot />
        </Link>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: ["active", "href", "as"],

    computed: {
        classes() {
            return 'block pl-3 pr-4 py-2 border-l-4 text-base font-medium focus:outline-none transition '+ this.active
                ? "border-teal-400 text-teal-500 focus:text-teal-800 focus:bg-teal-100 focus:border-teal-700"
                : "border-transparent text-lv-3 hover:focus:text-gray-800 hover:focus:bg-gray-50 bg-lv-3 hover:focus:border-gray-300";
        },
    },
});
</script>

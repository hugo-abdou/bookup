<template>
    <div>
        <button
            type="submit"
            class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-200 text-left hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 transition"
            v-if="as == 'button'"
        >
            <slot></slot>
        </button>

        <a
            :href="href"
            class="block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 transition"
            v-else-if="as == 'a'"
        >
            <slot></slot>
        </a>

        <Link
            :href="href"
            class="block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 transition"
            v-else
        >
            <slot></slot>
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
    props: ["href", "as"],
});
</script>

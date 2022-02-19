<template>
    <div>
        <button
            type="submit"
            :class="clases+' w-full'"
            v-if="$props.as == 'button'"
        >
            <slot></slot>
        </button>

        <a
            :href="href"
             :class="clases"
            v-else-if="$props.as == 'a'"
        >
            <slot></slot>
        </a>

        <Link
            :href="href"
             :class="clases"
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
    data(){
        return{
            clases:'block px-4 py-2 text-sm leading-5 transition text-lv-3 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100'
        }
    },
});
</script>

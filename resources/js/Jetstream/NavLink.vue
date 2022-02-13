<template>
    <Link
        :class="[
            'flex items-center space-x-2 font-semibold group',
            active ? 'text-teal-500' : 'text-gray-400',
        ]"
        :href="href"
    >
        <component
            :class="i == 1 && 'group-hover:translate-x-2 duration-200'"
            v-for="(el, i) in $slots.default()"
            :is="el"
        />
    </Link>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: ["href", "active"],
});
</script>

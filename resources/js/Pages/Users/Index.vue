<template>
    <app-layout title="Users">
        <users-table />
        <actions>
            <secondary-button @click="">
                <Link :href="route('users.create')">
                    <PlusIcon class="w-5 h-5 text-gray-500" />
                </Link>
            </secondary-button>
        </actions>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import UsersTable from "./Partials/UsersTable.vue";
import Actions from "@/Jetstream/Actions.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { PlusIcon } from "@heroicons/vue/outline";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Link,
        AppLayout,
        UsersTable,
        Actions,
        SecondaryButton,
        PlusIcon,
    },
    setup() {
        return {};
    },
});
</script>

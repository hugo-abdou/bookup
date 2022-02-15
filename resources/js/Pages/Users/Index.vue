<template>
    <app-layout title="Users">
        <users-table />

        <actions>
            <secondary-button
                v-tooltip="{
                    text: 'Add New User',
                    theme: { placement: 'left' },
                }"
                v-if="can('create user')"
            >
                <Link :href="route('users.create')">
                    <PlusIcon class="w-5 h-5 text-gray-500" />
                </Link>
            </secondary-button>
        </actions>
        <template #pagination>
            <pagination :pages="$page.props.users" />
        </template>
    </app-layout>
</template>

<script>
import { defineComponent, onUnmounted, ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import UsersTable from "./Partials/UsersTable.vue";
import Actions from "@/Jetstream/Actions.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { PlusIcon } from "@heroicons/vue/outline";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import useCan from "@composables/useCan";
import Pagination from "@/Jetstream/Pagination.vue";

export default defineComponent({
    components: {
        Link,
        AppLayout,
        UsersTable,
        Actions,
        SecondaryButton,
        PlusIcon,
        Pagination,
    },
    setup() {
        const { can } = useCan();
        return { can };
    },
});
</script>

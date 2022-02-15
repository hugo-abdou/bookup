<template>
    <app-layout title="Users">
        <roles-table />

        <actions>
            <secondary-button
                v-tooltip="{
                    text: 'Add New Role',
                    theme: { placement: 'left' },
                }"
                @click=""
            >
                <Link :href="route('roles.create')">
                    <PlusIcon class="w-5 h-5 text-gray-500" />
                </Link>
            </secondary-button>
        </actions>
        <template #pagination>
            <pagination :pages="$page.props.roles" />
        </template>
    </app-layout>
</template>

<script>
import { defineComponent, onUnmounted, ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import RolesTable from "./Partials/RolesTable.vue";
import Actions from "@/Jetstream/Actions.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { PlusIcon } from "@heroicons/vue/outline";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Pagination from "@/Jetstream/Pagination.vue";

export default defineComponent({
    components: {
        Link,
        AppLayout,
        RolesTable,
        Actions,
        SecondaryButton,
        PlusIcon,
        Pagination,
    },
    setup() {
        return {};
    },
});
</script>

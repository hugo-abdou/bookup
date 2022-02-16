<template>
    <app-layout title="Projects">
        <projects-table />

        <actions>
            <secondary-button
                v-tooltip="{
                    text: 'Add New Project',
                    theme: { placement: 'left' },
                }"
                v-if="can('create project')"
            >
                <Link :href="route('projects.create')">
                    <PlusIcon class="w-5 h-5 text-gray-500" />
                </Link>
            </secondary-button>
        </actions>
        <template #pagination>
            <pagination :pages="$page.props.projects" />
        </template>
    </app-layout>
</template>

<script>
import { defineComponent, onUnmounted, ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import ProjectsTable from "./Partials/ProjectsTable.vue";
import Actions from "@/Jetstream/Actions.vue";
import SecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { PlusIcon } from "@heroicons/vue/outline";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import Pagination from "@/Jetstream/Pagination.vue";
import useCan from "@composables/useCan";

export default defineComponent({
    components: {
        Link,
        AppLayout,
        ProjectsTable,
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

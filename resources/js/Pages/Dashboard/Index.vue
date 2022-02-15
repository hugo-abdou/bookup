<template>
    <app-layout title="Dashboard">
        <div class="grid grid-cols-3">
            <users-card />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import UsersCard from "./Partials/UsersCard.vue";

export default {
    components: {
        AppLayout,
        UsersCard,
    },
    setup() {
        return {};
    },
};
</script>

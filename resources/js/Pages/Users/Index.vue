<template>
	<app-layout title="Users">
		<users-table />
	</app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import UsersTable from "./Partials/UsersTable.vue";

export default defineComponent({
	components: {
		AppLayout,
		UsersTable,
	},
	setup() {
		return {};
	},
});
</script>

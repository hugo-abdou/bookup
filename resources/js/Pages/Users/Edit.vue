<template>
	<app-layout title="Settings">
		<update-profile-information-form :user="$page.props.editAbleUser" />

		<jet-section-border />

		<update-password-form :user="$page.props.editAbleUser" class="mt-10 sm:mt-0" />

		<jet-section-border />
		<logout-other-browser-sessions-form
			:user="$page.props.editAbleUser"
			:sessions="sessions"
			class="mt-10 sm:mt-0"
		/>
		<jet-section-border />

		<delete-user-form :user="$page.props.editAbleUser" class="mt-10 sm:mt-0" />
	</app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import DeleteUserForm from "@/Pages/Users/Partials/DeleteUserForm.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import UpdatePasswordForm from "@/Pages/Users/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Users/Partials/UpdateProfileInformationForm.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Users/Partials/LogoutOtherBrowserSessionsForm.vue";

export default defineComponent({
	props: ["sessions"],
	components: {
		AppLayout,
		DeleteUserForm,
		JetSectionBorder,
		UpdatePasswordForm,
		UpdateProfileInformationForm,
		LogoutOtherBrowserSessionsForm,
	},
	setup() {
		return {};
	},
});
</script>

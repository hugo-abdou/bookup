<template>
	<app-layout title="Settings">
		<TabGroup>
			<TabList class="px-2 sm:px-0 grid gap-1 grid-cols-3 sm:grid-cols-5 divide-x divide-gray-200">
				<Tab v-for="tag in tags" :key="tag" as="template" v-slot="{ selected }">
					<a
						href="#"
						class="font-semibold shadow rounded-lg group relative min-w-0 overflow-hidden bg-white py-4 px-2 text-sm md:text-base text-center hover:bg-gray-50 focus:z-10 inline-block"
						aria-current="page"
					>
						<span :class="selected? 'text-teal-500': 'text-gray-500'">{{tag}}</span>
						<span
							aria-hidden="true"
							v-if="selected"
							class="bg-teal-300 absolute inset-x-0 bottom-0 h-0.5"
						></span>
					</a>
				</Tab>
			</TabList>
			<TabPanels class="mt-2">
				<TabPanel v-if="$page.props.jetstream.canUpdateProfileInformation">
					<div v-if="$page.props.jetstream.canUpdateProfileInformation">
						<update-profile-information-form :user="$page.props.user" />

						<jet-section-border />
					</div>

					<div v-if="$page.props.jetstream.canUpdatePassword">
						<update-password-form class="mt-10 sm:mt-0" />

						<jet-section-border />
					</div>

					<div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
						<two-factor-authentication-form class="mt-10 sm:mt-0" />

						<jet-section-border />
					</div>

					<logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

					<template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
						<jet-section-border />

						<delete-user-form class="mt-10 sm:mt-0" />
					</template>
				</TabPanel>
			</TabPanels>
		</TabGroup>
	</app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue";
import TwoFactorAuthenticationForm from "@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

export default defineComponent({
	props: ["sessions"],
	components: {
		AppLayout,
		TabGroup,
		TabList,
		Tab,
		TabPanels,
		TabPanel,
		DeleteUserForm,
		JetSectionBorder,
		LogoutOtherBrowserSessionsForm,
		TwoFactorAuthenticationForm,
		UpdatePasswordForm,
		UpdateProfileInformationForm,
	},
	setup() {
		const tags = ["Profile", "Projects"];
		return { tags };
	},
});
</script>

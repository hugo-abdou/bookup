<template>
    <app-layout title="Settings">
        <TabGroup>
            <TabList
                class="grid grid-cols-3 gap-1 px-2 divide-x divide-gray-200 sm:px-0 sm:grid-cols-5"
            >
                <Tab v-for="tag in tags" :key="tag" as="template" v-slot="{ selected }">
                    <a
                        href="#"
                        class="relative inline-block min-w-0 px-2 py-4 overflow-hidden text-sm font-semibold text-center rounded-lg shadow group md:text-base hover:bg-gray-50 bg-lv-3 focus:z-10"
                        aria-current="page"
                    >
                        <span
                            :class="
                                selected
                                    ? 'text-teal-500'
                                    : 'text-gray-500 dark:text-gray-100 dark:group-hover:text-gray-500'
                            "
                            >{{ tag }}</span
                        >
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

                    <logout-other-browser-sessions-form
                        :sessions="sessions"
                        class="mt-10 sm:mt-0"
                    />

                    <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                        <jet-section-border />

                        <delete-user-form class="mt-10 sm:mt-0" />
                    </template>
                </TabPanel>
                <TabPanel>
                    <div
                        class="w-full bg-white rounded-md shadow-md h-96 bg-lv-2"
                    >
                        <h2 class="p-5 text-3xl text-gray-400">New Tab Section</h2>
                    </div>
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

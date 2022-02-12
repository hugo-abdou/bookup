<template>
    <jet-action-section>
        <template #title>Browser Sessions</template>

        <template #description>
            Manage and log out
            <b>{{ user.name }}</b> active sessions on other browsers and
            devices.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600 dark:text-white">
                If necessary, you may log out all of
                <b>{{ user.name }}</b> other browser sessions across all of this
                <b>{{ user.name }}</b> devices. Some of
                <b>{{ user.name }}</b> recent sessions are listed below;
                however, this list may not be exhaustive. If you feel
                <b>{{ user.name }}</b> account has been compromised, you should
                also update <b>{{ user.name }}</b> password.
            </div>

            <!-- Other Browser Sessions -->
            <div class="mt-5 space-y-6" v-if="sessions.length > 0">
                <div
                    class="flex items-center"
                    v-for="(session, i) in sessions"
                    :key="i"
                >
                    <div>
                        <svg
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            class="w-8 h-8 text-gray-500"
                            v-if="session.agent.is_desktop"
                        >
                            <path
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        </svg>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="w-8 h-8 text-gray-500"
                            v-else
                        >
                            <path d="M0 0h24v24H0z" stroke="none" />
                            <rect x="7" y="4" width="10" height="16" rx="1" />
                            <path d="M11 5h2M12 17v.01" />
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600 dark:text-white">
                            {{
                                session.agent.platform
                                    ? session.agent.platform
                                    : "Unknown"
                            }}
                            -
                            {{
                                session.agent.browser
                                    ? session.agent.browser
                                    : "Unknown"
                            }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ session.ip_address }},
                                <span
                                    class="text-green-500 font-semibold"
                                    v-if="session.is_current_device"
                                    >This device</span
                                >
                                <span v-else
                                    >Last active {{ session.last_active }}</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <jet-button @click="confirmLogout"
                    >Log Out Other Browser Sessions</jet-button
                >

                <jet-action-message :on="form.recentlySuccessful" class="ml-3"
                    >Done.</jet-action-message
                >
            </div>

            <!-- Log Out Other Devices Confirmation Modal -->
            <jet-dialog-modal :show="confirmingLogout" @close="closeModal">
                <template #title>Log Out Other Browser Sessions</template>

                <template #content>
                    Please enter
                    <b>your</b> password to confirm you would like to log out of
                    <b>{{ user.name }}</b> from other browser sessions across
                    all of <b>{{ user.name }}</b> devices.
                    <div class="mt-4">
                        <jet-input
                            type="password"
                            class="mt-1 block w-3/4"
                            placeholder="Password"
                            ref="password"
                            v-model="form.password"
                            :error="form.errors.password"
                            @keyup.enter="logoutOtherBrowserSessions"
                        />

                        <jet-input-error
                            :message="form.errors.password"
                            class="mt-2"
                        />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal"
                        >Cancel</jet-secondary-button
                    >

                    <jet-button
                        class="ml-3"
                        @click="logoutOtherBrowserSessions"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        >Log Out Other Browser Sessions</jet-button
                    >
                </template>
            </jet-dialog-modal>
        </template>
    </jet-action-section>
</template>

<script>
import { defineComponent } from "vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default defineComponent({
    props: ["sessions", "user"],

    components: {
        JetActionMessage,
        JetActionSection,
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton,
    },

    data() {
        return {
            confirmingLogout: false,

            form: this.$inertia.form({
                password: "",
            }),
        };
    },

    methods: {
        confirmLogout() {
            this.confirmingLogout = true;

            setTimeout(() => this.$refs.password.focus(), 250);
        },

        logoutOtherBrowserSessions() {
            this.form.put(
                route("users.update", this.user.id) +
                    "?action=destroy_sessions",
                {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                }
            );
        },

        closeModal() {
            this.confirmingLogout = false;

            this.form.reset();
        },
    },
});
</script>

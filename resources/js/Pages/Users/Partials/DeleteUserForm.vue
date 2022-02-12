<template>
    <jet-action-section>
        <template #title>Delete Account</template>

        <template #description>Permanently delete your account.</template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600 dark:text-white">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Before deleting your account, please
                download any data or information that you wish to retain.
            </div>

            <div class="mt-5">
                <JetConfirmsPassword @confirmed="destroy(user.id)">
                    <jet-danger-button>Delete Account</jet-danger-button>
                </JetConfirmsPassword>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
import { defineComponent } from "vue";
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetConfirmsPassword from "@/Jetstream/ConfirmsPassword.vue";
import DeleteUserModel from "./DeleteUserModel.vue";
import useDeleteUser from "@composables/useDeleteUser";

export default defineComponent({
    components: {
        JetActionSection,
        JetDangerButton,
        DeleteUserModel,
        JetConfirmsPassword,
    },
    props: ["user"],
    setup() {
        const { destroy } = useDeleteUser();
        return {
            destroy,
        };
    },
});
</script>

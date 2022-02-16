<template>
    <app-layout title="Create New Project">
        <jet-form-section @submitted="createNewProject">
            <template #title>Project Information</template>

            <template #description
                >Fill Project information and Permissions</template
            >

            <template #form>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="name" value="Name" />
                    <jet-input
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        autocomplete="name"
                        :error="form.errors.name"
                    />
                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3"
                    >Saved.</jet-action-message
                >

                <jet-button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    >Save</jet-button
                >
            </template>
        </jet-form-section>
    </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { Inertia } from "@inertiajs/inertia";

export default defineComponent({
    components: {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },
    props: ["permissions"],

    data() {
        return {
            form: this.$inertia.form({
                name: "",
                permissions: [],
            }),
        };
    },

    methods: {
        createNewProject() {
            this.form.post(route("projects.store"), {
                errorBag: "createNewProject",
                preserveScroll: true,
            });
        },
    },
});
</script>

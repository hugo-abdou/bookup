<template>
    <app-layout title="Create New project">
        <jet-form-section @submitted="createNewProject">
            <template #title>project Information</template>

            <template #description
                >Fill project information and Permissions</template
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
import Checkbox from "@/Jetstream/Checkbox.vue";

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
        Checkbox,
    },
    props: ["project"],
    data() {
        return {
            form: this.$inertia.form({
                name: this.project.name,
            }),
        };
    },

    methods: {
        createNewProject() {
            this.form.put(route("projects.update", this.project.id), {
                preserveScroll: true,
            });
        },
    },
});
</script>

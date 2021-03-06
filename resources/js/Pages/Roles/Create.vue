<template>
    <app-layout title="Create New Role">
        <jet-form-section @submitted="createNewRole">
            <template #title>Role Information</template>

            <template #description
                >Fill Role information and Permissions</template
            >

            <template #form>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="name" value="Name" />
                    <jet-input
                        id="name"
                        type="text"
                        class="block w-full mt-1"
                        v-model="form.name"
                        autocomplete="name"
                        :error="form.errors.name"
                    />
                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>
                <div
                    class="grid grid-cols-1 col-span-6 gap-4 md:grid-cols-2 lg:grid-cols-3"
                >
                    <template v-for="per in permissions">
                        <div class="flex items-center justify-between">
                            <jet-label
                                :for="per.id + '-permission'"
                                class="w-full pr-2 cursor-pointer"
                            >
                                <div class="relative">
                                    <div
                                        class="absolute inset-0 flex items-center pt-1"
                                        aria-hidden="true"
                                    >
                                        <div
                                            class="w-full border-t border-gray-300 dark:border-gray-500"
                                        />
                                    </div>
                                    <div class="relative flex justify-start">
                                        <span
                                            class="pr-2 text-sm text-gray-500 bg-lv-2"
                                        >
                                            {{ per.name }}
                                        </span>
                                    </div>
                                </div>
                            </jet-label>
                            <input
                                type="checkbox"
                                :value="per.id"
                                v-model="form.permissions"
                                :id="per.id + '-permission'"
                                class="text-teal-600 border-gray-300 rounded shadow-sm focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-50"
                            />
                        </div>
                    </template>
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
        createNewRole() {
            this.form.post(route("roles.store"), {
                errorBag: "createNewRole",
                preserveScroll: true,
            });
        },
    },
});
</script>

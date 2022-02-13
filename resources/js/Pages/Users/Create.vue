<template>
    <app-layout title="Create New User">
        <jet-form-section @submitted="createNewUser">
            <template #title>Profile Information</template>

            <template #description
                >Fill account's profile information and email address.</template
            >

            <template #form>
                <!-- Profile Photo -->
                <div class="col-span-6">
                    <!-- Profile Photo File Input -->
                    <input
                        type="file"
                        class="hidden"
                        ref="photo"
                        @change="updatePhotoPreview"
                    />

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" v-show="photoPreview">
                        <span
                            class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                            :style="
                                'background-image: url(\'' +
                                photoPreview +
                                '\');'
                            "
                        ></span>
                    </div>

                    <jet-secondary-button
                        class="mt-2 mr-2"
                        type="button"
                        @click.prevent="selectNewPhoto"
                        >Select A New Photo</jet-secondary-button
                    >

                    <jet-input-error
                        :message="form.errors.photo"
                        class="mt-2"
                    />
                </div>

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

                <!-- Email -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="email" value="Email" />
                    <jet-input
                        :error="form.errors.email"
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                    />
                    <jet-input-error
                        :message="form.errors.email"
                        class="mt-2"
                    />
                </div>
                <!-- password -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label for="password" value="Password" />
                    <jet-input
                        :error="form.errors.password"
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                    />
                    <jet-input-error
                        :message="form.errors.password"
                        class="mt-2"
                    />
                </div>
                <!-- password -->
                <div class="col-span-6 sm:col-span-3">
                    <jet-label
                        for="password_confirmation"
                        value="Confirme Password"
                    />
                    <jet-input
                        :error="form.errors.password"
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                    />
                    <jet-input-error
                        :message="form.errors.password"
                        class="mt-2"
                    />
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

    props: ["user"],

    data() {
        return {
            form: this.$inertia.form({
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                photo: null,
                terms: true,
            }),

            photoPreview: null,
        };
    },

    methods: {
        createNewUser() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0];
            }

            this.form.post(route("users.store"), {
                errorBag: "createNewUser",
                preserveScroll: true,
                onSuccess: () => this.clearPhotoFileInput(),
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const photo = this.$refs.photo.files[0];

            if (!photo) return;

            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(photo);
        },

        clearPhotoFileInput() {
            if (this.$refs.photo?.value) {
                this.$refs.photo.value = null;
            }
        },
    },
});
</script>

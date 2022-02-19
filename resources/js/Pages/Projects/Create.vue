<template>
    <app-layout title="Create New Project">
        <tab-group :selectedIndex="selectedIndex">
            <tab-list class="grid grid-cols-3 gap-1 px-2 -mb-0.5 divide-x divide-gray-200 sm:px-0 sm:grid-cols-5">
                <tab as="template" v-slot="{ selected }">
                     <a
                        href="#"
                        class="relative inline-block min-w-0 px-2 py-4 overflow-hidden text-sm font-semibold text-center rounded-t-lg shadow group md:text-base hover:bg-gray-50 bg-lv-3 focus:z-10"
                        aria-current="page"
                    >
                        <span
                            :class="
                                selected
                                    ? 'text-teal-500'
                                    : 'text-gray-500 dark:text-gray-100 dark:group-hover:text-gray-500'
                            "
                        >Project Meta</span>
                        <span aria-hidden="true" v-if="selected" class="bg-teal-300 absolute inset-x-0 bottom-0 h-0.5"></span>
                    </a>
                </tab>
            </tab-list>
            <tab-panels>
                <tab-panel>
                    <jet-form-section class="!rounded-tl-none" @submitted="createNewProject">
                        <template #title>Project Information</template>

                        <template #description>Fill Project information and Permissions</template>
                        <template #form>
                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-3">
                                <jet-label for="name" value="Name" />
                                <jet-input id="name" type="text" class="block w-full mt-1" v-model="form.name" autocomplete="name" :error="form.errors.name" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>
                            <!-- domain name -->
                            <div class="col-span-6 sm:col-span-3">
                                <jet-label for="domainName" value="Domain Name" />
                                <jet-input id="domainName" type="text" class="block w-full mt-1" v-model="form.domain_name" :error="form.errors.domain_name" />
                                <jet-input-error :message="form.errors.domain_name" class="mt-2" />
                            </div>
                            <!-- description -->
                            <div class="col-span-6">
                                <jet-label for="description" value="Description" />
                                <JetTextarea id="description" class="block w-full mt-1" v-model="form.description" :error="form.errors.description" />
                                <jet-input-error :message="form.errors.description" class="mt-2" />
                            </div>
                        </template>

                        <template #actions>
                            <jet-action-message :on="form.recentlySuccessful" class="mr-3">Saved.</jet-action-message>

                            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</jet-button>
                        </template>
                    </jet-form-section>
                </tab-panel>
            </tab-panels>
        </tab-group>
    </app-layout>
</template>

<script>
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import { defineComponent, ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetTextarea from "@/Jetstream/Textarea.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";

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
        TabGroup,
        TabList,
        Tab,
        TabPanels,
        TabPanel,
        JetTextarea,
    },
    props: ["permissions"],
    setup(props) {
        const selectedIndex = ref(0);
        const form = useForm({
            name: "",
            domain_name: "",
            description: "",
        });
        function createNewProject() {
            form.post(route("projects.store"), {
                errorBag: "createNewProject",
                preserveScroll: true,
            });
        }
        return { createNewProject, selectedIndex, form };
    },
});
</script>

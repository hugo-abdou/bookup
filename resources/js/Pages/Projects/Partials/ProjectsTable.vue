<template>
    <div class="flex flex-col">
        <div class="-my-2 sm:-mx-6 lg:-mx-8">
            <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
            >
                <div class="shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Permissions</th>
                                <th scope="col" class="sr-only">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="project in $page.props.projects.data"
                                :key="project.id"
                            >
                                <td>{{ project.id }}</td>
                                <td>{{ project.name }}</td>
                                <td>
                                    <div class="flex flex-wrap gap-1">
                                        <span
                                            v-for="per in project.permissions"
                                            :key="per"
                                            class="px-2 capitalize inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-700"
                                            >{{ per }}</span
                                        >
                                    </div>
                                </td>

                                <td>
                                    <div class="space-x-2 flex justify-center">
                                        <Link
                                            v-if="can('update project')"
                                            class="inline-block dark:border-gray-500 hover:text-gray-400 shadow-md border p-1 rounded-md active:shadow-none"
                                            :href="
                                                route(
                                                    'projects.edit',
                                                    project.id
                                                )
                                            "
                                        >
                                            <PencilAltIcon class="w-5" />
                                        </Link>
                                        <a
                                            v-if="can('destroy project')"
                                            href="#"
                                            class="inline-block dark:border-gray-500 text-red-400 hover:text-red-300 shadow-md border p-1 rounded-md active:shadow-none"
                                            @click="deleteProject(project.id)"
                                        >
                                            <TrashIcon class="w-5" />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <JetConfirmsPassword @confirmed="destroy()">
        <a ref="DeleteUserModel" href="#"></a>
    </JetConfirmsPassword>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import JetConfirmsPassword from "@/Jetstream/ConfirmsPassword.vue";
import { ref } from "@vue/reactivity";
import { PencilAltIcon, TrashIcon } from "@heroicons/vue/outline";
import useCan from "@composables/useCan";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        Link,
        PencilAltIcon,
        TrashIcon,
        JetConfirmsPassword,
    },
    setup() {
        const DeleteUserModel = ref(null);
        const project = ref(null);
        function destroy() {
            Inertia.delete(route("projects.destroy", project.value));
        }
        function deleteProject(id) {
            project.value = id;
            DeleteUserModel.value.click();
        }
        const { can } = useCan();
        return { destroy, deleteProject, DeleteUserModel, can };
    },
};
</script>

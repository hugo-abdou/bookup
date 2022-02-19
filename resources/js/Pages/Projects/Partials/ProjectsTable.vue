<template>
    <div class="flex flex-col">
        <div class="-my-2 sm:-mx-6 lg:-mx-8">
            <div
                class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
            >
                <div class="overflow-hidden shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Domain</th>
                                <th scope="col">Description</th>
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
                                <td>{{ project.domain_name }}</td>
                                <td>{{ project.description }}</td>
                                <td>
                                    <div class="flex justify-center space-x-2">
                                        <Link
                                            v-if="can('update project')"
                                            class="inline-block p-1 border rounded-md shadow-md dark:border-gray-500 hover:text-gray-400 active:shadow-none"
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
                                            class="inline-block p-1 text-red-400 border rounded-md shadow-md dark:border-gray-500 hover:text-red-300 active:shadow-none"
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

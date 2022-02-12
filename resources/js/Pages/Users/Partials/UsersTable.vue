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
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Role</th>
                                <th scope="col" class="sr-only">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="person in $page.props.users.data"
                                :key="person.id"
                            >
                                <td>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img
                                                class="h-10 w-10 rounded-full"
                                                :src="person.profile_photo_url"
                                                alt
                                            />
                                        </div>
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-600 dark:text-white dark:text-white dark:text-white"
                                            >
                                                {{ person.name }}
                                            </div>
                                            <div
                                                class="text-sm text-gray-500 dark:text-gray-400"
                                            >
                                                {{ person.email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                        >Active</span
                                    >
                                </td>
                                <td>{{ person.role }}</td>
                                <td>
                                    <div class="space-x-2 flex justify-center">
                                        <Link
                                            class="inline-block dark:border-gray-500 hover:text-gray-400 shadow-md border p-1 rounded-md active:shadow-none"
                                            v-if="
                                                $page.props.user.id !==
                                                person.id
                                            "
                                            :href="
                                                route('users.edit', person.id)
                                            "
                                        >
                                            <PencilAltIcon class="w-5" />
                                        </Link>
                                        <a
                                            href="#"
                                            class="inline-block dark:border-gray-500 text-red-400 hover:text-red-300 shadow-md border p-1 rounded-md active:shadow-none"
                                            v-if="
                                                $page.props.user.id !==
                                                person.id
                                            "
                                            @click="
                                                () => {
                                                    user = person;
                                                    $refs.ConfirmsPassword.click();
                                                }
                                            "
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
    <JetConfirmsPassword @confirmed="destroy(user.id)">
        <a ref="ConfirmsPassword" href="#"></a>
    </JetConfirmsPassword>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import DeleteUserModel from "./DeleteUserModel.vue";
import JetConfirmsPassword from "@/Jetstream/ConfirmsPassword.vue";
import useDeleteUser from "@composables/useDeleteUser";
import { ref } from "@vue/reactivity";
import { PencilAltIcon, TrashIcon } from "@heroicons/vue/outline";

export default {
    components: {
        Link,
        DeleteUserModel,
        PencilAltIcon,
        TrashIcon,
        JetConfirmsPassword,
    },
    setup() {
        const user = ref(null);

        const { destroy } = useDeleteUser(() => {
            user.value = null;
        });
        return { destroy, user };
    },
};
</script>

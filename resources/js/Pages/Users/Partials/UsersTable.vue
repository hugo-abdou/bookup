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
                                <td>{{ person.id }}</td>
                                <td>
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img
                                                class="w-10 h-10 rounded-full"
                                                :src="person.profile_photo_url"
                                                alt
                                            />
                                        </div>
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-lv-3"
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
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full"
                                        >Active</span
                                    >
                                </td>
                                <td>{{ person.role }}</td>
                                <td>
                                    <div class="flex justify-center space-x-2">
                                        <Link
                                            class="inline-block p-1 border rounded-md shadow-md dark:border-gray-500 hover:text-gray-400 active:shadow-none"
                                            v-if="
                                                $page.props.user.id !==
                                                    person.id &&
                                                can('update user')
                                            "
                                            :href="
                                                route('users.edit', person.id)
                                            "
                                        >
                                            <PencilAltIcon class="w-5" />
                                        </Link>
                                        <a
                                            href="#"
                                            class="inline-block p-1 text-red-400 border rounded-md shadow-md dark:border-gray-500 hover:text-red-300 active:shadow-none"
                                            v-if="
                                                $page.props.user.id !==
                                                    person.id &&
                                                can('destroy user')
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
import useCan from "@composables/useCan";
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
            // onsuccess
            user.value = null;
        });
        const { can } = useCan();
        return { destroy, user, can };
    },
};
</script>

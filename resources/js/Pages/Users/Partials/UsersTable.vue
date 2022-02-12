<template>
    <div class="flex flex-col">
        <div class="-my-2 sm:-mx-6 lg:-mx-8">
            <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
            >
                <div
                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                >
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Name
                                </th>

                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Status
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Role
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr
                                v-for="person in $page.props.users.data"
                                :key="person.id"
                            >
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{ person.name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ person.email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                        >Active</span
                                    >
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                >
                                    {{ person.role }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2"
                                >
                                    <Link
                                        v-if="$page.props.user.id !== person.id"
                                        :href="route('users.edit', person.id)"
                                        class="text-indigo-600 hover:text-indigo-900 inline-block"
                                        >Edit</Link
                                    >
                                    <a
                                        v-if="$page.props.user.id !== person.id"
                                        @click="
                                            () => {
                                                user = person;
                                                $refs.ConfirmsPassword.click();
                                            }
                                        "
                                        class="text-indigo-600 hover:text-indigo-900 cursor-pointer"
                                        >delete</a
                                    >
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

export default {
    components: { Link, DeleteUserModel, JetConfirmsPassword },
    setup() {
        const user = ref(null);

        const { destroy } = useDeleteUser(() => {
            user.value = null;
        });
        return { destroy, user };
    },
};
</script>

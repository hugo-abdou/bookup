<template>
    <div
        class="bg-white dark:bg-gray-700 text-gray-600 dark:text-white duration-200 overflow-hidden shadow rounded-lg"
    >
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <UserGroupIcon class="h-6 w-6" aria-hidden="true" />
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="font-semibold truncate">Users</dt>
                        <dd>
                            <div
                                class="text-lg font-semibold text-gray-900 dark:text-gray-300 duration-200"
                            >
                                {{ $page.props.users }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 dark:bg-gray-800 duration-200 px-5 py-3">
            <div class="text-sm">
                <Link
                    :href="route('users.index')"
                    class="font-medium text-cyan-700 hover:text-cyan-900"
                >
                    View all
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { UserGroupIcon } from "@heroicons/vue/solid";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        UserGroupIcon,
        Link,
    },
};
</script>

<style></style>

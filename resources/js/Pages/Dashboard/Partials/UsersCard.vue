<template>
    <div
        class="overflow-hidden rounded-lg shadow text-lv-3 bg-lv-3"
    >
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <UserGroupIcon class="w-6 h-6" aria-hidden="true" />
                </div>
                <div class="flex-1 w-0 ml-5">
                    <dl>
                        <dt class="font-semibold truncate">Users</dt>
                        <dd>
                            <div
                                class="text-lg font-semibold text-lv-1"
                            >
                                {{ $page.props.users }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="px-5 py-3 bg-lv-2">
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

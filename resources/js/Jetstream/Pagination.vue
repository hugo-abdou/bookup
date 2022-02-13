<template>
    <nav
        class="border-t border-gray-300 dark:border-gray-500 px-4 flex items-center justify-between sm:px-0"
    >
        <div class="-mt-px w-0 flex-1 flex">
            <Link
                :href="pages.links.prev"
                v-if="pages.links.prev"
                class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-400"
            >
                <ArrowNarrowLeftIcon
                    class="mr-3 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
                Previous
            </Link>
            <span
                v-else
                class="border-transparent text-gray-500 border-t-2 pt-4 inline-flex items-center text-sm font-medium"
            >
                <ArrowNarrowLeftIcon
                    class="mr-3 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
                Previous
            </span>
        </div>
        <div class="hidden md:-mt-px md:flex">
            <template v-for="(page, index) in pages.meta.links" :key="index">
                <Link
                    :href="page.url"
                    v-if="
                        !page.label.includes('Previous') &&
                        !page.label.includes('Next') &&
                        !page.label.includes('...')
                    "
                    :class="[
                        'border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium',
                        page.active
                            ? 'border-teal-300 text-teal-400 font-bold'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-400',
                    ]"
                >
                    {{ page.label }}
                </Link>

                <span
                    v-if="page.label.includes('...')"
                    class="border-transparent text-gray-500 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"
                >
                    ...
                </span>
            </template>
        </div>
        <div class="-mt-px w-0 flex-1 flex justify-end">
            <Link
                :href="pages.links.next"
                v-if="pages.links.next"
                class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-400"
            >
                Next
                <ArrowNarrowRightIcon
                    class="ml-3 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </Link>
            <span
                v-else
                class="border-transparent text-gray-500 border-t-2 pt-4 inline-flex items-center text-sm font-medium"
            >
                Next
                <ArrowNarrowRightIcon
                    class="ml-3 h-5 w-5 text-gray-400"
                    aria-hidden="true"
                />
            </span>
        </div>
    </nav>
</template>

<script>
import {
    ArrowNarrowLeftIcon,
    ArrowNarrowRightIcon,
} from "@heroicons/vue/solid";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        ArrowNarrowLeftIcon,
        ArrowNarrowRightIcon,
        Link,
    },
    props: ["pages"],
};
</script>

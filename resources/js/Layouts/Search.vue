<template>
    <div class="flex w-2/4 justify-center lg:justify-end">
        <div class="w-full px-2 lg:px-6">
            <label for="search" class="sr-only">Search projects</label>
            <div class="relative text-cyan-700">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <SearchIcon
                        @click="search"
                        class="h-5 w-5 cursor-pointer"
                    />
                </div>
                <input
                    @keypress.enter="search"
                    v-model="input"
                    class="block w-full pl-10 pr-3 py-2 rounded-md leading-5 bg-white/60 border-cyan-500 focus:border-cyan-500 focus:outline-none focus:ring-0 sm:text-sm"
                    placeholder="Search projects"
                    type="search"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { SearchIcon } from "@heroicons/vue/outline";
import { usePage } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import { useDebounceFn } from "@vueuse/core";
import { Inertia } from "@inertiajs/inertia";
export default {
    components: { SearchIcon },
    setup() {
        const { url } = usePage();
        let pageUrl = url.value.split("?")[0];

        const input = ref("");

        function search() {
            Inertia.get(
                pageUrl + `?s=${input.value}`,
                {},
                { preserveState: true, preserveScroll: true }
            );
        }

        return { search, input };
    },
};
</script>

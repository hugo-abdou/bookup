<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div
            :class="[
                'duration-300 lg:pl-64 h-screen relative overflow-auto scrollbar-thin scrollbar-thumb-rounded-full scrollbar-thumb-gray-400',
                !showingSideBar ? '' : '',
                isDark ? 'bg-gray-900 ' : 'bg-gray-100 ',
            ]"
        >
            <!-- navbar -->
            <nav ref="navbar" class="fixed inset-x-0 z-50">
                <!-- Primary Navigation Menu -->
                <div class="bg-gradient-primary shadow">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between items-center h-16">
                            <div class="flex justify-between w-full">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center">
                                    <Link :href="route('home')">
                                        <jet-application-mark
                                            class="block h-9 w-auto"
                                        />
                                    </Link>
                                </div>

                                <search />

                                <!-- Navigation Links -->
                                <div class="flex items-center gap-x-2">
                                    <!-- Hamburger -->
                                    <button
                                        @click="
                                            showingSideBar = !showingSideBar
                                        "
                                        class="inline-flex items-center justify-center text-white hover:text-gray-300 focus:outline-none transition lg:hidden"
                                    >
                                        <MenuAlt2Icon
                                            v-if="!showingSideBar"
                                            class="h-6 w-6"
                                        />
                                        <XIcon
                                            v-if="showingSideBar"
                                            class="h-6 w-6"
                                        />
                                    </button>
                                    <button
                                        @click="toggleDark"
                                        class="inline-flex items-center justify-center text-white hover:text-gray-300 focus:outline-none transition"
                                    >
                                        <MoonIcon v-if="isDark" class="w-6" />
                                        <SunIcon v-else class="w-6" />
                                        <span class="sr-only"
                                            >toggle dark mode</span
                                        >
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="relative">
                                    <!-- Teams Dropdown -->
                                    <jet-dropdown
                                        align="right"
                                        width="60"
                                        v-if="
                                            $page.props.jetstream
                                                .hasTeamFeatures
                                        "
                                    >
                                        <template #trigger>
                                            <span
                                                class="inline-flex rounded-md"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                                                >
                                                    {{
                                                        $page.props.user
                                                            .current_team.name
                                                    }}
                                                    <svg
                                                        class="ml-2 -mr-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <div class="w-60">
                                                <!-- Team Management -->
                                                <template
                                                    v-if="
                                                        $page.props.jetstream
                                                            .hasTeamFeatures
                                                    "
                                                >
                                                    <div
                                                        class="block px-4 py-2 text-xs text-gray-400"
                                                    >
                                                        Manage Team
                                                    </div>

                                                    <!-- Team Settings -->
                                                    <jet-dropdown-link
                                                        :href="
                                                            route(
                                                                'teams.show',
                                                                $page.props.user
                                                                    .current_team
                                                            )
                                                        "
                                                    >
                                                        Team Settings
                                                    </jet-dropdown-link>

                                                    <jet-dropdown-link
                                                        :href="
                                                            route(
                                                                'teams.create'
                                                            )
                                                        "
                                                        v-if="
                                                            $page.props
                                                                .jetstream
                                                                .canCreateTeams
                                                        "
                                                    >
                                                        Create New Team
                                                    </jet-dropdown-link>

                                                    <div
                                                        class="border-t border-gray-100"
                                                    ></div>

                                                    <!-- Team Switcher -->
                                                    <div
                                                        class="block px-4 py-2 text-xs text-gray-400"
                                                    >
                                                        Switch Teams
                                                    </div>

                                                    <template
                                                        v-for="team in $page
                                                            .props.user
                                                            .all_teams"
                                                        :key="team.id"
                                                    >
                                                        <form
                                                            @submit.prevent="
                                                                switchToTeam(
                                                                    team
                                                                )
                                                            "
                                                        >
                                                            <jet-dropdown-link
                                                                as="button"
                                                            >
                                                                <div
                                                                    class="flex items-center"
                                                                >
                                                                    <svg
                                                                        v-if="
                                                                            team.id ==
                                                                            $page
                                                                                .props
                                                                                .user
                                                                                .current_team_id
                                                                        "
                                                                        class="mr-2 h-5 w-5 text-green-400"
                                                                        fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        stroke="currentColor"
                                                                        viewBox="0 0 24 24"
                                                                    >
                                                                        <path
                                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                                                        />
                                                                    </svg>
                                                                    <div>
                                                                        {{
                                                                            team.name
                                                                        }}
                                                                    </div>
                                                                </div>
                                                            </jet-dropdown-link>
                                                        </form>
                                                    </template>
                                                </template>
                                            </div>
                                        </template>
                                    </jet-dropdown>
                                </div>

                                <!-- Settings Dropdown -->
                                <div class="ml-2 relative">
                                    <jet-dropdown align="right" width="48">
                                        <template #trigger>
                                            <button
                                                v-if="
                                                    $page.props.jetstream
                                                        .managesProfilePhotos
                                                "
                                                class="text-sm mt-1 border-2 border-transparent focus:outline-none focus:border-transparent transition"
                                            >
                                                <div
                                                    class="flex-shrink-0 h-10 w-10"
                                                >
                                                    <img
                                                        class="h-10 w-10 rounded-full"
                                                        :src="
                                                            $page.props.user
                                                                .profile_photo_url
                                                        "
                                                        :alt="
                                                            $page.props.user
                                                                .name
                                                        "
                                                    />
                                                </div>
                                            </button>

                                            <span
                                                v-else
                                                class="inline-flex rounded-md"
                                            >
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                                >
                                                    {{ $page.props.user.name }}
                                                    <svg
                                                        class="ml-2 -mr-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div
                                                class="block px-4 py-2 text-xs text-gray-400"
                                            >
                                                Manage Account
                                            </div>

                                            <jet-dropdown-link
                                                :href="route('profile.show')"
                                            >
                                                <span class="flex">
                                                    <CogIcon
                                                        class="w-5 text-gray-500 mr-2"
                                                    />Settings
                                                </span>
                                            </jet-dropdown-link>

                                            <jet-dropdown-link
                                                :href="
                                                    route('api-tokens.index')
                                                "
                                                v-if="
                                                    $page.props.jetstream
                                                        .hasApiFeatures
                                                "
                                                >API Tokens</jet-dropdown-link
                                            >

                                            <div
                                                class="border-t border-gray-100"
                                            ></div>

                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <jet-dropdown-link as="button">
                                                    <span class="flex">
                                                        <LogoutIcon
                                                            class="w-5 text-gray-500 mr-2"
                                                        />Log Out
                                                    </span>
                                                </jet-dropdown-link>
                                            </form>
                                        </template>
                                    </jet-dropdown>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Side bar -->
            <div
                :class="[
                    'fixed inset-y-0 left-0 z-[49] w-64 pt-16 transform duration-300 border-r lg:-translate-x-0',
                    !showingSideBar ? '-translate-x-64' : '',
                    isDark
                        ? 'bg-gray-800 border-gray-700'
                        : 'bg-white border-gray-200 ',
                ]"
            >
                <div class="py-5 px-4">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 space-y-8">
                            <div class="space-y-8">
                                <!-- Profile -->
                                <Link
                                    :href="route('profile.show')"
                                    class="flex items-center space-x-3"
                                >
                                    <div
                                        v-if="
                                            $page.props.jetstream
                                                .managesProfilePhotos
                                        "
                                        class="flex-shrink-0 h-12 w-12"
                                    >
                                        <img
                                            class="h-12 w-12 rounded-full"
                                            :src="
                                                $page.props.user
                                                    .profile_photo_url
                                            "
                                            :alt="$page.props.user.name"
                                        />
                                    </div>
                                    <div
                                        class="space-y-1 text-xs text-gray-400 font-medium"
                                    >
                                        <div
                                            class="text-sm font-medium text-gray-900 dark:text-white"
                                        >
                                            {{ $page.props.user.name }}
                                        </div>
                                        <span
                                            class="flex items-center space-x-1"
                                        >
                                            <UserCircleIcon class="w-5" />
                                            <span>admin</span>
                                        </span>
                                        <span
                                            class="flex items-center space-x-1"
                                        >
                                            <MailIcon class="w-5" />
                                            <span>
                                                {{ $page.props.user.email }}
                                            </span>
                                        </span>
                                    </div>
                                </Link>
                                <!-- Action buttons -->
                                <div class="flex flex-col">
                                    <Button type="button">New Project</Button>
                                    <secondary-button type="button" class="mt-2"
                                        >Invite Team</secondary-button
                                    >
                                </div>
                            </div>
                            <!-- Meta info -->
                            <div class="space-y-4">
                                <template
                                    v-for="link in sideBarLinks"
                                    :key="link.name"
                                >
                                    <jet-nav-link
                                        v-if="link.can"
                                        :href="route(link.route)"
                                        :active="route().current(link.route)"
                                    >
                                        <component
                                            :is="link.icon"
                                            class="w-5"
                                        />
                                        <span>{{ link.name }}</span>
                                    </jet-nav-link>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Content -->
            <main
                class="relative max-w-7xl min-h-screen mx-auto py-20 sm:px-2 lg:px-8"
            >
                <h1 class="text-2xl font-bold text-gray-600 mb-5">
                    {{ title }}
                </h1>
                <slot></slot>
                <div
                    v-if="$slots.pagination"
                    class="absolute bottom-5 inset-x-10"
                >
                    <slot name="pagination"></slot>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref, toRefs, watch } from "vue";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import {
    UserCircleIcon,
    MenuAlt2Icon,
    UserIcon,
    CogIcon,
    MailIcon,
    LogoutIcon,
    MoonIcon,
    SunIcon,
    XIcon,
} from "@heroicons/vue/outline";
import Button from "../Jetstream/Button.vue";
import SecondaryButton from "../Jetstream/SecondaryButton.vue";
import { useLinks, useDarkMode } from "@config";
import { Inertia } from "@inertiajs/inertia";
import Search from "./Search.vue";
export default defineComponent({
    props: {
        title: String,
        loadMoreWithScroll: {
            type: Boolean,
            default: false,
        },
    },

    components: {
        SunIcon,
        XIcon,
        MoonIcon,
        Head,
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Link,
        Button,
        SecondaryButton,
        UserCircleIcon,
        MenuAlt2Icon,
        UserIcon,
        CogIcon,
        MailIcon,
        LogoutIcon,
        Search,
    },

    setup(props, { emit }) {
        const showingSideBar = ref(false);
        const classes = ref(false);
        const { isDark, toggleDark } = useDarkMode();
        const { sideBarLinks } = useLinks();

        function switchToTeam(team) {
            Inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        }

        function logout() {
            Inertia.post(route("logout"));
        }

        return {
            sideBarLinks,
            toggleDark,
            isDark,
            showingSideBar,
            classes,
            logout,
            switchToTeam,
        };
    },
});
</script>

import { HomeIcon, UsersIcon } from "@heroicons/vue/outline";
import { useDark, useToggle } from "@vueuse/core";
import { ref } from "vue";
import useCan from "@composables/useCan";

const isDark = useDark();
const toggleDark = useToggle(isDark);

export function useDarkMode() {
    return { toggleDark, isDark };
}

export function useLinks() {
    const { can } = useCan();

    const sideBarLinks = ref([
        {
            name: "dashboard",
            route: "dashboard",
            icon: HomeIcon,
            can: true,
        },
        {
            name: "users",
            route: "users.index",
            icon: UsersIcon,
            can: can("show user"),
        },
        {
            name: "roles",
            route: "roles.index",
            icon: UsersIcon,
            can: can("show role"),
        },
    ]);
    return { sideBarLinks };
}

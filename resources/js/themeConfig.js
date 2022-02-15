import { HomeIcon, UsersIcon } from "@heroicons/vue/outline";
import { useDark, useToggle } from "@vueuse/core";
import { ref } from "vue";

const isDark = useDark();
const toggleDark = useToggle(isDark);

export function useDarkMode() {
    return { toggleDark, isDark };
}

export function useLinks() {
    const sideBarLinks = ref([
        {
            name: "dashboard",
            route: "dashboard",
            icon: HomeIcon,
            disabled: false,
        },
        {
            name: "users",
            route: "users.index",
            icon: UsersIcon,
            disabled: false,
        },
        {
            name: "roles",
            route: "roles.index",
            icon: UsersIcon,
            disabled: false,
        },
    ]);
    return { sideBarLinks };
}

import { HomeIcon, UsersIcon } from "@heroicons/vue/outline";
import { useDark, useToggle } from "@vueuse/core";

const isDark = useDark();
const toggleDark = useToggle(isDark);

export function useDarkMode() {
    return { toggleDark, isDark };
}

export const sideBarLinks = [
    { name: "Dashboard", route: "dashboard", icon: HomeIcon },
    { name: "Users", route: "users", icon: UsersIcon },
];

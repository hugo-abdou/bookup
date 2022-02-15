import { usePage } from "@inertiajs/inertia-vue3";

export default function useCan() {
    const { can: permissions } = usePage().props.value.jetstream;

    function can(permission) {
        return permissions.includes(permission);
    }

    return { can };
}

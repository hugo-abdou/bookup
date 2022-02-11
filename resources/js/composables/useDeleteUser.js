import { Inertia } from "@inertiajs/inertia";
export default function useDeleteUser() {
    function destroy(id) {
        Inertia.delete("/users/" + id, {
            preserveScroll: true,
            preserveState: true,
        });
    }
    return { destroy };
}

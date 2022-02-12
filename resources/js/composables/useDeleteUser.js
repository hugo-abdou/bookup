import { Inertia } from "@inertiajs/inertia";
export default function useDeleteUser(cb) {
    function destroy(id) {
        Inertia.delete("/users/" + id, {
            preserveScroll: true,
            preserveState: true,
            onSuccess() {
                cb();
            },
        });
    }
    return { destroy };
}

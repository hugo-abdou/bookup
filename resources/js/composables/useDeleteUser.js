import { Inertia } from "@inertiajs/inertia";
export default function useDeleteUser(cb = null) {
    function destroy(id) {
        Inertia.delete("/users/" + id, {
            preserveScroll: true,
            preserveState: true,
            onSuccess() {
                if (cb) {
                    cb();
                }
            },
        });
    }
    return { destroy };
}

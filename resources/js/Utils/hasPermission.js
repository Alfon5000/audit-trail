import { usePage } from "@inertiajs/vue3";

const hasPermission = (permission) =>
  usePage()
    .props.auth.user.permissions.map((permission) => permission.name)
    .includes(permission);

export default hasPermission;

import { usePage } from "@inertiajs/vue3";

const hasRole = (role) =>
  usePage()
    .props.auth.user.roles.map((role) => role.name)
    .includes(role);

export default hasRole;

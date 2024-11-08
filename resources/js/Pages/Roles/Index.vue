<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import hasPermission from "@/Utils/hasPermission";

export default {
  props: {
    roles: Object,
  },
  components: {
    AuthenticatedLayout,
    Head,
    Link,
    PrimaryButton,
    DangerButton,
  },
  setup() {
    const deleteRole = (id) => {
      if (confirm("Are you sure you want to delete this role?")) {
        Inertia.delete(route("roles.destroy", id));
      }
    };
    return {
      deleteRole,
      hasPermission,
    };
  },
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Roles" />
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Roles</h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6">
              <Link
                :href="route('roles.create')"
                v-show="hasPermission('create role')"
                ><PrimaryButton>Create</PrimaryButton>
              </Link>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full table-auto">
                <thead>
                  <tr class="border-b border-gray-200 bg-gray-800 text-white">
                    <th class="px-4 py-2 text-start">#</th>
                    <th class="px-4 py-2 text-start">Name</th>
                    <th class="px-4 py-2 text-start">Permissions</th>
                    <th class="px-4 py-2 text-start">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-if="roles.length > 0"
                    v-for="(role, index) in roles"
                    :key="role.id"
                    class="border-b border-gray-200"
                  >
                    <td class="px-4 py-2">
                      {{ ++index }}
                    </td>
                    <td class="px-4 py-2">
                      {{ role.name }}
                    </td>
                    <td class="px-4 py-2 space-x-1 space-y-1">
                      <span
                        v-if="role.permissions.length > 0"
                        v-for="permission in role.permissions"
                        :key="permission.id"
                        class="inline-block px-2 rounded-lg bg-green-500 text-white text-sm"
                      >
                        {{ permission.name }}
                      </span>
                      <span
                        v-else
                        class="inline-block px-2 rounded-lg bg-red-500 text-white text-sm"
                      >
                        no permission
                      </span>
                    </td>
                    <td class="px-4 py-2 flex justify-start items-center">
                      <Link
                        :href="route('roles.edit', role.id)"
                        v-show="hasPermission('edit role')"
                      >
                        <PrimaryButton class="me-1">Edit</PrimaryButton>
                      </Link>
                      <Link
                        :href="route('roles.destroy', role.id)"
                        method="delete"
                        as="button"
                        @click="deleteRole(role.id)"
                        v-show="hasPermission('delete role')"
                      >
                        <DangerButton>Delete</DangerButton>
                      </Link>
                    </td>
                  </tr>
                  <tr v-else class="border-b border-gray-200">
                    <td class="px-4 py-2 text-center text-red-500" colspan="7">
                      No role found
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import hasPermission from "@/Utils/hasPermission";

export default {
  props: {
    users: Object,
  },
  components: {
    AuthenticatedLayout,
    Head,
    Link,
    PrimaryButton,
    DangerButton,
  },
  setup() {
    const deleteUser = (id) => {
      if (confirm("Are you sure you want to delete this user?")) {
        Inertia.delete(route("users.destroy", id));
      }
    };

    return {
      deleteUser,
      hasPermission,
    };
  },
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Users" />
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Users</h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6">
              <Link
                :href="route('users.create')"
                v-show="hasPermission('create user')"
                ><PrimaryButton>Create</PrimaryButton>
              </Link>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full table-auto">
                <thead>
                  <tr class="border-b border-gray-200 bg-gray-800 text-white">
                    <th class="px-4 py-2 text-start">#</th>
                    <th class="px-4 py-2 text-start">Name</th>
                    <th class="px-4 py-2 text-start">Roles</th>
                    <th class="px-4 py-2 text-start">Permissions</th>
                    <th class="px-4 py-2 text-start">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-if="users.length > 0"
                    v-for="(user, index) in users"
                    :key="user.id"
                    class="border-b border-gray-200"
                  >
                    <td class="px-4 py-2">
                      {{ ++index }}
                    </td>
                    <td class="px-4 py-2">
                      {{ user.name }}
                    </td>
                    <td class="px-4 py-2 space-x-1 space-y-1">
                      <span
                        v-if="user.roles.length > 0"
                        v-for="role in user.roles"
                        :key="role.id"
                        class="inline-block px-2 rounded-lg bg-blue-500 text-white text-sm"
                      >
                        {{ role.name }}
                      </span>
                      <span
                        v-else
                        class="inline-block px-2 rounded-lg bg-red-500 text-white text-sm"
                      >
                        no role
                      </span>
                    </td>
                    <td class="px-4 py-2 space-x-1 space-y-1">
                      <span
                        v-if="user.permissions.length > 0"
                        v-for="permission in user.permissions"
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
                        :href="route('users.edit', user.id)"
                        v-show="hasPermission('edit user')"
                      >
                        <PrimaryButton class="me-1">Edit</PrimaryButton>
                      </Link>
                      <Link
                        :href="route('users.destroy', user.id)"
                        method="delete"
                        as="button"
                        @click="deleteUser(user.id)"
                        v-show="hasPermission('delete user')"
                      >
                        <DangerButton>Delete</DangerButton>
                      </Link>
                    </td>
                  </tr>
                  <tr v-else class="border-b border-gray-200">
                    <td class="px-4 py-2 text-center text-red-500" colspan="7">
                      No user found
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

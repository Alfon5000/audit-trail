<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
  props: {
    activities: Object,
  },
  components: {
    AuthenticatedLayout,
    Head,
    Link,
    PrimaryButton,
  },
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Activities" />
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Activities
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="overflow-x-auto">
              <table class="w-full table-auto">
                <thead>
                  <tr class="border-b border-gray-200 bg-gray-800 text-white">
                    <th class="px-4 py-2 text-start">#</th>
                    <th class="px-4 py-2 text-start">User ID</th>
                    <th class="px-4 py-2 text-start">User Name</th>
                    <th class="px-4 py-2 text-start">Menu</th>
                    <th class="px-4 py-2 text-start">Method</th>
                    <th class="px-4 py-2 text-start">Logged At</th>
                    <th class="px-4 py-2 text-start">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-if="activities.length > 0"
                    v-for="(activity, index) in activities"
                    :key="activity.id"
                    class="border-b border-gray-200"
                  >
                    <td class="px-4 py-2">
                      {{ ++index }}
                    </td>
                    <td class="px-4 py-2">
                      {{ activity.causer.id }}
                    </td>
                    <td class="px-4 py-2">
                      {{ activity.causer.name }}
                    </td>
                    <td class="px-4 py-2">
                      {{ activity.menu }}
                    </td>
                    <td class="px-4 py-2">
                      {{ activity.method }}
                    </td>
                    <td class="px-4 py-2">
                      {{ activity.created_at }}
                    </td>
                    <td class="px-4 py-2 flex justify-start items-center">
                      <Link :href="route('activities.show', activity.id)">
                        <PrimaryButton>Details</PrimaryButton>
                      </Link>
                    </td>
                  </tr>
                  <tr v-else class="border-b border-gray-200">
                    <td class="px-4 py-2 text-center text-red-500" colspan="7">
                      No activity found
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

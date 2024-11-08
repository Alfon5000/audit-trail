<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Textarea from "@/Components/Textarea.vue";

export default {
  props: {
    activity: Object,
  },
  components: {
    AuthenticatedLayout,
    Head,
    Link,
    PrimaryButton,
    InputLabel,
    TextInput,
    Textarea,
  },
  setup(props) {
    console.log(props.activity.changes);
  },
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Activity Details" />
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Activity Details
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6">
              <Link :href="route('activities.index')"
                ><PrimaryButton>Back</PrimaryButton>
              </Link>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full table-auto">
                <thead>
                  <tr class="border-b border-gray-200 bg-gray-800 text-white">
                    <th class="px-4 py-2 text-start">User ID</th>
                    <th class="px-4 py-2 text-start">User Name</th>
                    <th class="px-4 py-2 text-start">Menu</th>
                    <th class="px-4 py-2 text-start">Method</th>
                    <th class="px-4 py-2 text-start">Logged At</th>
                    <th class="px-4 py-2 text-start">Old Value</th>
                    <th class="px-4 py-2 text-start">Current Value</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="border-b border-gray-200">
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
                    <td class="px-4 py-2">
                      <ul>
                        <li
                          v-if="activity.changes.old"
                          v-for="(old, key) in activity.changes.old"
                        >
                          {{ `${key}: ${old}` }}
                        </li>
                        <p v-else>No value</p>
                      </ul>
                    </td>
                    <td class="px-4 py-2">
                      <ul>
                        <li
                          v-if="activity.changes.attributes"
                          v-for="(attributes, key) in activity.changes
                            .attributes"
                        >
                          {{ `${key}: ${attributes}` }}
                        </li>
                        <p v-else>No value</p>
                      </ul>
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

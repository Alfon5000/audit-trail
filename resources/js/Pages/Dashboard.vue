<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";

export default {
  components: {
    AuthenticatedLayout,
    Head,
  },
  setup() {
    const greet = () => {
      const now = new Date();
      const hour = now.getHours();

      let greeting;

      if (hour >= 5 && hour < 12) {
        greeting = "Good Morning";
      } else if (hour >= 12 && hour < 15) {
        greeting = "Good Day";
      } else if (hour >= 15 && hour < 18) {
        greeting = "Good Afternoon";
      } else if (hour >= 18 && hour < 22) {
        greeting = "Good Evening";
      } else {
        greeting = "Good Night";
      }

      return greeting;
    };

    const date = () => {
      const date = new Date();
      const options = {
        day: "numeric",
        month: "long",
        year: "numeric",
      };

      return date.toLocaleDateString("en-US", options);
    };

    return {
      greet,
      date,
    };
  },
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center gap-x-2">
              <div class="text-lg font-semibold">
                {{ greet() }}, {{ $page.props.auth.user.name }}!
              </div>
              <div class="text-lg font-semibold">
                {{ date() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

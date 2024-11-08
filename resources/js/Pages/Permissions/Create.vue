<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

export default {
  components: {
    AuthenticatedLayout,
    Head,
    Link,
    PrimaryButton,
    SecondaryButton,
    InputLabel,
    TextInput,
    InputError,
  },
  setup() {
    const form = useForm({
      name: "",
    });

    const storePermission = () => {
      form.post(route("permissions.store"));
    };

    return {
      form,
      storePermission,
    };
  },
};
</script>
<template>
  <AuthenticatedLayout>
    <Head title="Create Permission" />
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Create Permission
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <form @submit.prevent="storePermission">
              <div class="mb-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  autofocus
                  placeholder="Enter permission name..."
                />
                <InputError class="mt-2" :message="form.errors.name" />
              </div>
              <div class="flex justify-end items-center gap-x-2">
                <Link :href="route('permissions.index')">
                  <SecondaryButton>Cancel</SecondaryButton>
                </Link>
                <PrimaryButton
                  :disabled="form.processing"
                  :class="{ 'opacity-25': form.processing }"
                >
                  Save
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

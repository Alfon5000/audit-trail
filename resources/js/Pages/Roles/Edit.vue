<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import VueMultiselect from "vue-multiselect";

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
    VueMultiselect,
  },
  props: {
    role: Object,
    permissions: Object,
  },
  setup(props) {
    const form = useForm({
      name: props.role.name,
      permissions: props.role.permissions,
    });

    const updateRole = (id) => {
      form.put(route("roles.update", id));
    };

    return {
      form,
      updateRole,
    };
  },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<template>
  <AuthenticatedLayout>
    <Head title="Edit Role" />
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Edit Role
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <form @submit.prevent="updateRole(role.id)">
              <div class="mb-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  autofocus
                  placeholder="Enter role name..."
                />
                <InputError class="mt-2" :message="form.errors.name" />
              </div>
              <div class="mb-4">
                <InputLabel for="permissions" value="Permissions" />
                <VueMultiselect
                  v-model="form.permissions"
                  :options="permissions"
                  :multiple="true"
                  :close-on-select="true"
                  placeholder="Select permissions..."
                  label="name"
                  track-by="name"
                />
                <InputError class="mt-2" :message="form.errors.permissions" />
              </div>
              <div class="flex justify-end items-center gap-x-2">
                <Link :href="route('roles.index')">
                  <SecondaryButton>Cancel</SecondaryButton>
                </Link>
                <PrimaryButton
                  :disabled="form.processing"
                  :class="{ 'opacity-25': form.processing }"
                >
                  Update
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

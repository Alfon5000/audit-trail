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
    user: Object,
    roles: Object,
    permissions: Object,
  },
  setup(props) {
    const form = useForm({
      name: props.user.name,
      email: props.user.email,
      password: props.user.password,
      password_confirmation: props.user.password_confirmation,
      roles: props.user.roles,
      permissions: props.user.permissions,
    });

    const updateUser = (id) => {
      form.put(route("users.update", id));
    };

    return {
      form,
      updateUser,
    };
  },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

<template>
  <AuthenticatedLayout>
    <Head title="Edit User" />
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Edit User
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <form @submit.prevent="updateUser(user.id)">
              <div class="mb-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  autofocus
                  placeholder="Enter user name..."
                />
                <InputError class="mt-2" :message="form.errors.name" />
              </div>
              <div class="mb-4">
                <InputLabel for="roles" value="Roles" />
                <VueMultiselect
                  v-model="form.roles"
                  :options="roles"
                  :multiple="true"
                  :close-on-select="true"
                  placeholder="Select roles..."
                  label="name"
                  track-by="name"
                />
                <InputError class="mt-2" :message="form.errors.roles" />
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
                <InputError class="mt-2" :message="form.errors.roles" />
              </div>
              <div class="mb-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                  id="email"
                  type="email"
                  class="mt-1 block w-full"
                  v-model="form.email"
                  placeholder="Enter user email..."
                />
                <InputError class="mt-2" :message="form.errors.email" />
              </div>
              <div class="mb-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                  id="password"
                  type="password"
                  class="mt-1 block w-full"
                  v-model="form.password"
                  placeholder="Enter user password..."
                />
                <InputError class="mt-2" :message="form.errors.password" />
              </div>
              <div class="mb-4">
                <InputLabel for="password_confirmation" value="Password" />
                <TextInput
                  id="password_confirmation"
                  type="password"
                  class="mt-1 block w-full"
                  v-model="form.password_confirmation"
                  placeholder="Enter user password confirmation..."
                />
                <InputError
                  class="mt-2"
                  :message="form.errors.password_confirmation"
                />
              </div>
              <div class="flex justify-end items-center gap-x-2">
                <Link :href="route('users.index')">
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

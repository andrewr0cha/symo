<template>
  <BreezeAuthenticatedLayout>
    <div class="flex">
      <div
        class="flex flex-col h-screen px-4 py-8 overflow-y-auto border-r"
        style="width: 600px !important"
      >
        <div class="flex flex-col mx-auto">
          <aside>
            <div class="flex sm:max-w-7xl mx-auto">
              <BreezeGuestLayout>
                <Head title="Layout" />

                <BreezeValidationErrors class="mb-4" />

                <div
                  v-if="status"
                  class="mb-4 font-medium text-sm text-green-600"
                >
                  {{ status }}
                </div>

                <form @submit.prevent="submit">
                  <div>
                    <BreezeLabel for="email" value="E-mail" />
                    <BreezeInput
                      id="email"
                      type="email"
                      class="mt-1 block w-full"
                      v-model="form.email"
                      required
                      autofocus
                      autocomplete="username"
                    />
                  </div>

                  <div class="mt-4">
                    <BreezeLabel for="password" value="Senha" />
                    <BreezeInput
                      id="password"
                      type="password"
                      class="mt-1 block w-full"
                      v-model="form.password"
                      required
                      autocomplete="current-password"
                    />
                  </div>

                  <!--<div class="block mt-4">
        <label class="flex items-center">
          <BreezeCheckbox name="remember" v-model:checked="form.remember" />
          <span class="ml-2 text-sm text-gray-600">Lembre-se de mim</span>
        </label>
      </div>-->

                  <div class="items-center justify-center mt-4">
                    <BreezeButton
                      class="ml-4"
                      :class="{ 'opacity-25': form.processing }"
                      :disabled="form.processing"
                    >
                      Login
                    </BreezeButton>
                    <br />
                    <Link
                      v-if="canResetPassword"
                      :href="route('password.request')"
                      class="
                        underline
                        text-sm text-gray-600
                        hover:text-gray-900
                      "
                    >
                      Esqueceu a senha?
                    </Link>
                  </div>
                </form>
              </BreezeGuestLayout>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
  <q-btn icon="menu"></q-btn>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButon from "@/Components/Button.vue";
import Texto from "@/Components/Text.vue";
import BreezeButton from "@/Components/Button.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<style scoped>
.fundo {
  background-color: black;
  max-width: 310px;
  border-radius: 20px;
}

.topo {
  background-color: white;
  text-align: center;
  width: 300px;
  height: 360px;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.imagem {
  display: inline-block;
  margin-right: 5px;
  width: 30px;
}

.calendario {
  background-color: black;
  border-radius: 20px;
  height: 360px;
}
.tempo {
  background-color: #1ed760;
  height: 360px;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}
.topo-calendario {
  background-color: white;
  height: 360px;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.consulta {
  background-color: white;
  text-align: center;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.metas {
  border: 2px solid black;
  border-radius: 20px;
  text-align: center;
}
</style>

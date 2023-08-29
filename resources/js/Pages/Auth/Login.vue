<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";

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
  form
    .transform((data) => ({
      ...data,
      remember: form.remember ? "on" : "",
    }))
    .post(route("login"), {
      onFinish: () => form.reset("password"),
    });
};

const showPassword = ref(false);

const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value;
};
</script>

<template>
  <Head title="Log in" />

  <AuthenticationCard>
    <template #logo>
      <AuthenticationCardLogo />
    </template>

    <div class="border-b border-gray-300 mb-12 mt-9 text-center w-[80%] mx-auto">
        <Link :href="route('login')">
            <span class="inline-block border-b-2 border-[#D90537] px-3 text-gray-600 cursor-pointer">Iniciar sesión</span>
        </Link>
        <Link :href="route('register')">
            <span class="inline-block px-3 text-gray-600 ml-4 cursor-pointer">Registrarse</span>
        </Link>
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          placeholder="Correo electrónico"
          class="input"
          required
          autofocus
          autocomplete="username"
        />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4 relative">
        <div class="flex justify-center items-center">
          <TextInput
            id="password"
            v-model="form.password"
            :type="showPassword ? 'text' : 'password'"
            placeholder="Contraseña"
            class="input"
            required
            autocomplete="current-password"
          />
          <i
            :class="showPassword ? 'fa fa-eye-slash' : 'fa fa-eye'"
            class="text-gray-400 ml-2 cursor-pointer absolute right-3 top-3"
            @click="togglePasswordVisibility"
          ></i>
        </div>
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <Checkbox v-model:checked="form.remember" name="remember" />
          <span class="ml-2 text-sm text-gray-600">No cerrar sesión</span>
        </label>
      </div>

        <div class="flex flex-col space-y-5 items-center justify-end mt-4">
          <Link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="underline text-sm text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Olvidé mi contraseña
          </Link>

          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Iniciar sesión <i class="fa-solid fa-arrow-right ml-2"></i>
          </PrimaryButton>
        </div>
    </form>
    <div class="mt-6">
        <p class="text-gray-500">¿No tienes cuenta? <span class="text-primary underline cursor-pointer ml-2">Crear cuenta</span></p>
        
        <div class="flex items-center mt-4">
            <div class="border-b-2 border-[#9A9A9A] w-1/2"></div>
            <p class="text-[#9A9A9A] mx-2">O</p>
            <div class="border-b-2 border-[#9A9A9A] w-1/2"></div>
        </div>

        <Link :href="route('password.request')">
            <p class="flex items-center w-full border border-[#9A9A9A] rounded-lg py-1 px-4 cursor-pointer mt-3"><i class="fa-brands fa-facebook text-lg mr-4"></i>Continuar con Facebook</p>
        </Link>
        <Link :href="route('password.request')">
            <p class="flex items-center w-full border border-[#9A9A9A] rounded-lg py-1 px-4 cursor-pointer mt-3"><i class="fa-brands fa-google text-lg mr-4"></i>Continuar con Google</p>
        </Link>
    </div>
  </AuthenticationCard>
</template>

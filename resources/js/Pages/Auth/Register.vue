<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";
import { ref } from "vue";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};

const showPassword = ref(false);

const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value;
};
</script>

<template>
  <Head title="Register" />

  <AuthenticationCard>
    <template #logo>
      <AuthenticationCardLogo />
    </template>

    <div class="border-b border-gray-300 mb-12 mt-9 text-center w-[80%] mx-auto">
      <Link :href="route('login')">
        <span class="inline-block px-3 text-gray-600 cursor-pointer">Iniciar sesión</span>
      </Link>
      <Link :href="route('register')">
        <span
          class="inline-block border-b-2 border-[#D90537] px-3 text-gray-600 ml-4 cursor-pointer"
          >Registrarse</span
        >
      </Link>
    </div>

    <form @submit.prevent="submit">
      <div>
        <TextInput
          id="name"
          v-model="form.name"
          type="text"
          placeholder="Nombre"
          class="input"
          required
          autofocus
          autocomplete="name"
        />
        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div class="mt-4">
        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          placeholder="Correo electrónico"
          class="input"
          required
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
            autocomplete="new-password"
          />
          <i
            :class="showPassword ? 'fa fa-eye-slash' : 'fa fa-eye'"
            class="text-gray-400 ml-2 cursor-pointer absolute right-3 top-3"
            @click="togglePasswordVisibility"
          ></i>
        </div>
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="mt-4">
        <TextInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          placeholder="Confirmar contraseña"
          class="input"
          required
          autocomplete="new-password"
        />
        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
        <InputLabel for="terms">
          <div class="flex items-center">
            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

            <div class="ml-2">
              I agree to the
              <a
                target="_blank"
                :href="route('terms.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >Terms of Service</a
              >
              and
              <a
                target="_blank"
                :href="route('policy.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >Privacy Policy</a
              >
            </div>
          </div>
          <InputError class="mt-2" :message="form.errors.terms" />
        </InputLabel>
      </div>

      <div class="mt-4 rounded-lg w-full border border-[#9A9A9A] p-4">
        <p class="font-bold mb-3">Su contraseña debe contener:</p>
        <ul>
          <li class="text-gray-500">- Al menos 8 caracteres</li>
          <li class="text-gray-500">- Letras minúsculas (a-z)</li>
          <li class="text-gray-500">- Letras mayúsculas (A-Z)</li>
          <li class="text-gray-500">- Números (0-9)</li>
        </ul>
      </div>

      <div class="flex flex-col items-center justify-center space-y-7 mt-7">

        <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Crear cuenta <i class="fa-solid fa-arrow-right ml-2"></i>
          </PrimaryButton>
        
        <div class="flex items-center">
          ¿Ya tienes cuenta?
          <Link
          :href="route('login')"
          class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        > <p class="text-primary underline cursor-pointer ml-4">Inicia sesión</p>
        </Link>
        </div>
      </div>
    </form>
    <Link :href="route('password.request')">
            <p class="flex items-center w-full border border-[#9A9A9A] rounded-lg py-1 px-4 cursor-pointer mt-3"><i class="fa-brands fa-facebook text-lg mr-4"></i>Continuar con Facebook</p>
        </Link>
        <Link :href="route('password.request')">
            <p class="flex items-center w-full border border-[#9A9A9A] rounded-lg py-1 px-4 cursor-pointer mt-3"><i class="fa-brands fa-google text-lg mr-4"></i>Continuar con Google</p>
        </Link>
  
  </AuthenticationCard>
</template>

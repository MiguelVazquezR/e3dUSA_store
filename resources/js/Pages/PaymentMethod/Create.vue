<template>
  <AppLayout title="Nuevo método de pago |">

    <div class="lg:px-20 lg:py-8">

        <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2 text-sm">
        <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('profile.show'))" class="cursor-pointer text-primary">Mi cuenta</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p>Agregar nuevo método de pago</p>
      </div>

      <form class="mx-auto p-4 lg:w-1/3 mt-24" @submit.prevent="store">
        <div class="mb-4">
          <select v-model="form.type" class="input">
            <option v-for="cardType in cardTypes" :key="cardType" :value="cardType">{{ cardType }}</option>
          </select>
          <InputError :message="form.errors.type" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.bank_name">Nombre del banco *</InputWithPlaceholder>
          <InputError :message="form.errors.bank_name" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.account_number">Número de cuenta *</InputWithPlaceholder>
          <InputError :message="form.errors.account_number" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.owner_name">Nombre del dueño de la cuenta *</InputWithPlaceholder>
          <InputError :message="form.errors.owner_name" />
        </div>
        <div class="text-right">
          <PrimaryButton :disabled="form.processing">Agregar información de pago</PrimaryButton>
        </div>
      </form>

    </div>


  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
data(){
  const form = useForm({
      type: null,
      bank_name: null,
      account_number: null,
      owner_name: null,
    });
    return{
      form,
      cardTypes:[
        'Tarjeta de crédito',
        'Tarjeta de débito',
      ],
    }
},
components:{
    AppLayout,
    Link,
    InputWithPlaceholder,
    InputError,
    PrimaryButton
},
props:{

},
methods:{
  store(){
    this.form.post(route('payment-methods.store'));
  }
},
}
</script>

<style>

</style>
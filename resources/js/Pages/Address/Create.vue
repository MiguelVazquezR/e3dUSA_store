<template>
  <AppLayout title="Nueva dirección">

    <div class="lg:px-20 lg:py-8">

        <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2 text-sm">
        <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('products.index'))" class="cursor-pointer text-primary">Productos</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('carts.index'))" class="cursor-pointer text-primary">Carrito</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('carts.payment-verification'))" class="cursor-pointer text-primary">Verifica tu pedido</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p>Agregar nueva dirección</p>
      </div>

      <form class="mx-auto p-4 lg:w-1/3 mt-24" @submit.prevent="store">
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.address">Dirección (Calle, número, colonia) *</InputWithPlaceholder>
          <InputError :message="form.errors.address" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.postal_code">C.P *</InputWithPlaceholder>
          <InputError :message="form.errors.postal_code" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.city">Ciudad *</InputWithPlaceholder>
          <InputError :message="form.errors.city" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.state">Estado *</InputWithPlaceholder>
          <InputError :message="form.errors.state" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.country">País *</InputWithPlaceholder>
          <InputError :message="form.errors.country" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.receiver_name">Nombre de quien recibe *</InputWithPlaceholder>
          <InputError :message="form.errors.receiver_name" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.phone">Teléfono *</InputWithPlaceholder>
          <InputError :message="form.errors.phone" />
        </div>
        <div class="text-right">
          <PrimaryButton>Agregar dirección</PrimaryButton>
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
      address: null,
      city: null,
      state: null,
      country: null,
      postal_code: null,
      receiver_name: null,
      phone: null,
      
    });
    return{
      form,
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
    this.form.post(route('addresses.store'));
  }
},
}
</script>

<style>

</style>
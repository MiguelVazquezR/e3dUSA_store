<template>
  <!-- -------------- Large screen view ----------------------- -->
  <section class="hidden lg:block">
    <div class="flex justify-between">
      <div class="flex space-x-4">
        <div @click="$inertia.get(route('products.show', cart_product.product?.id))" class="rounded-lg cursor-pointer">
          <figure class="w-40 h-28">
            <img :src="cart_product.product?.media[0]?.original_url" alt="" class="object-contain bg-no-repeat w-40 h-28">
          </figure>
        </div>
        <div>
          <p @click="$inertia.get(route('products.show', cart_product.product?.id))" class="cursor-pointer font-bold">{{
            cart_product.product.name }}</p>
          <p>Marca: {{ cart_product.product.brand }}</p>
          <p>Modelo: {{ cart_product.product.model }}</p>
          <p>Características: {{ cart_product.product.features }}</p>
        </div>
      </div>
      <div class="flex space-x-4 mr-14">
        <div class="text-center space-y-3">
          <p>Precio: ${{ cart_product.product?.price?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</p>
          <div class="flex items-center space-x-4 my-4 relative">
            <p class="font-bold text-sm">Cantidad:</p>
            <input @change="updateQuantity()" v-model="form.quantity" type="number" min="1" :disabled="loading"
              :id="'myNumberInput' + cart_product.id"
              class="input w-20 h-6 bg-[#D9D9D9] border border-transparent rounded-xl disabled:cursor-not-allowed disabled:opacity-50">
            <div></div>
            <i v-if="loading" class="absolute right-0 top-0 fa-solid fa-spinner fa-spin text-sm text-primary"></i>
          </div>
          <p class="text-secondary">Total: ${{ (cart_product.product?.price *
            form.quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</p>
        </div>
      </div>
    </div>
    <div class="flex items-center mt-4 ml-5 text-sm text-gray-600">
      <p @click="deleteConfirm = true" class="cursor-pointer"><i class="fa-solid fa-trash-can mr-2"></i>Eliminar</p>
      <div class="border-r border-[#9A9A9A] h-6 mx-3 "></div>
      <p class="cursor-pointer">Guardad para después</p>
    </div>
    <div class="border-b borer-[#9A9A9A] w-full my-7"></div>
  </section>

  <!-- ------------------- Responsive screen view ------------------------ -->
  <section class="lg:hidden text-xs">
    <div class="p-5 flex space-x-3">
      <figure @click="$inertia.get(route('products.show', cart_product.product?.id))"
        class="bg-[#D9D9D9] w-28 h-24 rounded-md">
        <img :src="cart_product.product?.media[0]?.original_url" alt="" class="object-contain bg-no-repeat w-28 h-24">
      </figure>
      <div>
        <p @click="$inertia.get(route('products.show', cart_product.product?.id))" class="cursor-pointer font-bold">{{
          cart_product.product.name }}</p>
        <p>Marca: {{ cart_product.product.brand }}</p>
        <p>Modelo: {{ cart_product.product.model }}</p>
        <p>Características: {{ cart_product.product.features }}</p>
        <p>Precio: ${{ cart_product.product?.price?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</p>
        <p class="text-secondary font-bold text-sm">Total: ${{ (cart_product.product?.price *
          form.quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</p>
      </div>
    </div>
    <div class="flex justify-between px-8">
      <div class="flex items-center">
        <button @click="decreaseQuantity()" :disabled="loading"
          class="rounded-l-md bg-[#D9D9D9] w-6 h-5 font-bold disabled:cursor-not-allowed disabled:opacity-50">-</button>
        <p class="px-3 text-base text-secondary">{{ form.quantity }}</p>
        <button @click="increaseQuantity()" :disabled="loading"
          class="rounded-r-md bg-[#D9D9D9] w-6 h-5 font-bold disabled:cursor-not-allowed disabled:opacity-50">+</button>
        <i v-if="loading" class="fa-solid fa-spinner fa-spin text-sm text-primary ml-2"></i>
      </div>
      <div class="flex">
        <button @click="deleteConfirm = true" class="bg-[#D9D9D9] rounded-sm mr-2 text-xs px-2"><i
            class="fa-solid fa-trash-can"></i></button>
        <button class="bg-[#D9D9D9] rounded-md text-xs px-2">Guardad para después</button>
      </div>
    </div>
    <div class="border-b borer-[#9A9A9A] w-full mt-4"></div>
  </section>

  <!-- -------------- Modal starts----------------------- -->
  <DialogModal :show="deleteConfirm" @close="deleteConfirm = false">
    <template #title>
      <p v-if="deleteConfirm"><i class="fa-solid fa-circle-exclamation text-red-600 mr-2"></i> ¿Continuar con la
        eliminación?</p>
    </template>
    <template #content>
      <p v-if="deleteConfirm">Estas a punto de quitar {{ cart_product.product.name }} de tu carrito. ¿Deseas continuar?
      </p>
    </template>
    <template #footer>
      <CancelButton @click="deleteConfirm = false" class="mr-2">
        Cerrar</CancelButton>
      <PrimaryButton @click="deleteItem" v-if="deleteConfirm">Eliminar</PrimaryButton>
    </template>
  </DialogModal>
  <!-- --------------------------- Modal ends ------------------------------------ -->
</template>

<script>
import { Link, useForm } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import axios from "axios";

export default {
  data() {
    const form = useForm({
      quantity: this.cart_product.quantity,
    });
    return {
      form,
      oldQuantity: null,
      deleteConfirm: false,
      loading: false,
    }
  },
  emits: ['updatedQuantity'],
  props: {
    cart_product: Object,
  },
  components: {
    Link,
    DialogModal,
    PrimaryButton,
    CancelButton
  },
  methods: {
    updateQuantity() {
      if (this.oldQuantity < this.form.quantity) this.increaseQuantity(false);
      else this.decreaseQuantity(false);
      this.oldQuantity = this.form.quantity;
    },
    async decreaseQuantity(isMobileView = true) {
      if (this.form.quantity > 1) {
        this.loading = true;
        try {
          const response = await axios.put(route('cart-products.decrease-quantity', this.cart_product));
          if (response.status === 200) {
            if (isMobileView) this.form.quantity -= 1;
            this.$emit('updated-quantity', {operator:'-', quantity:1});
          }
        } catch (error) {
          console.log(error);
        } finally {
          this.loading = false;
        }
      }
    },
    async increaseQuantity(isMobileView = true) {
      this.loading = true;
      try {
        const response = await axios.put(route('cart-products.increase-quantity', this.cart_product));
        if (response.status === 200) {
          if (isMobileView) this.form.quantity += 1;
          this.$emit('updatedQuantity', {operator:'+', quantity:1});
        }
      } catch (error) {
        console.log(error);
      } finally {
        this.loading = false;
      }
    },
    deleteItem() {
      this.$inertia.delete(route('cart-products.destroy', this.cart_product.id));
      this.deleteConfirm = false;
      this.$emit('updatedQuantity', {operator:'-', quantity:this.form.quantity});
    }
  },
  mounted() {
    this.oldQuantity = this.cart_product.quantity;

    const numberInput = document.getElementById('myNumberInput' + this.cart_product.id);
    numberInput.addEventListener('keydown', (event) => {
      // Obtén el código de la tecla presionada
      const keyCode = event.keyCode || event.which;

      // Verifica si la tecla presionada es un número (0-9)
      if ((keyCode >= 48 && keyCode <= 57) || keyCode === 101 || keyCode === 69) {
        // Evita que el evento de teclado se propague
        event.preventDefault();
      }
    });

  }
}
</script>
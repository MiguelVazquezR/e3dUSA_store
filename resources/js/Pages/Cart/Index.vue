<template>
  <AppLayout>
    <div class="lg:px-20 lg:py-8">

        <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2">
        <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('products.index'))" class="cursor-pointer">Productos</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('carts.index'))" class="cursor-pointer text-primary">Carrito</p>
      </div>

        <h2 class="text-secondary ml-7 my-3">Productos</h2>

        <div class="flex space-x-5">

<!-- --------------------- Products' cart section -------------------  -->
            <div class="border border-[#9A9A9A] rounded-lg w-2/3 p-5">

              <!-- ------ product cart component ------ -->
                <CartProductCard v-for="cart_product in cart_products" :key="cart_product" :cart_product="cart_product" />
              <!-- ------ product cart component end ------ -->

            </div>

<!-- ------------------ Total payment section ------------ -->
        <div class="w-1/3">
            <div class="border border-[#9A9A9A] rounded-lg p-5 flex flex-col space-y-2">
                <div class="flex justify-between">
                    <p class="font-bold text-sm">Subtotal:</p>
                    <p class=" text-sm">${{subtotal}}</p>
                </div>
                <div class="flex justify-between">
                    <p class="font-bold text-sm">Costo de envío:</p>
                    <p class=" text-sm">${{shipping_cost}}</p>
                </div>
                <div class="flex justify-between">
                    <p class="font-bold text-primary text-sm">Descuento:</p>
                    <p class=" text-sm text-primary">${{discount}}</p>
                </div>
                <div class="flex justify-between">
                    <p class="font-bold text-sm text-secondary">Total:</p>
                    <p class=" text-sm text-secondary">${{total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</p>
                </div>
            </div>
            <p class="text-secondary text-xs mt-2 mb-5">*El pedido debe solicitarse con al menos una semana de anticipación </p>
            <div class="text-center">
              <PrimaryButton class="px-24">Ir al pago</PrimaryButton>
            </div>
        </div>
        </div>

        <h2 class="text-secondary ml-7 my-14 mb-3">Cupón de descuento</h2>
        <div class="w-1/3 flex space-x-3">
          <input v-model="discount_code" type="text" class="input" placeholder="Ingresa un cupón de descuento">
          <PrimaryButton @click="apllyDiscount">Aplicar</PrimaryButton>
        </div>


        <ThirthButton @click="$inertia.get(route('products.index'))" class="border-[#D90537] !text-primary mt-9">Seguir comprando</ThirthButton>
    </div>

        
    <footer>
      <div
        class="bg-[#1a1a1a] h-auto w-full lg:grid grid-cols-3 text-center text-white relative"
      >
        <div class="py-7 px-5">
          <figure class="my-5">
            <img src="@/../../public/images/logo.png" alt="Logo" />
          </figure>
          <p class="font-bold text-white">Conocenos</p>
          <p class="text-white hover:underline cursor-pointer">Trabajar en emblems3d</p>
        </div>

        <div class="py-7 px-5">
          <p class="font-bold text-white mb-4">Productos</p>
          <ul>
            <li class="cursor-pointer hover:underline">Emblemas</li>
            <li class="cursor-pointer hover:underline">Portaplacas</li>
            <li class="cursor-pointer hover:underline">Llaveros</li>
            <li class="cursor-pointer hover:underline">Tapetes de uso rudo</li>
            <li class="cursor-pointer hover:underline">Portadocumentos</li>
            <li class="cursor-pointer hover:underline">Perfumeros</li>
            <li class="cursor-pointer hover:underline">Servicios de diseno</li>
          </ul>
        </div>

        <div class="py-7 px-5 text-left">
          <p class="font-bold text-white mb-4">Contacto</p>
          <p class="text-white">ventas@emblemas3d.com.mx</p>

          <p class="font-bold text-white mt-12 mb-4">Domicilio</p>
          <figure class="flex space-x-4">
            <img class="cursor-pointer" src="@/../../public/images/eua.png" alt="EUA" />
            <img class="cursor-pointer" src="@/../../public/images/mexico.png" alt="MX" />
          </figure>
        </div>
        <a href="https://dtw.com.mx/" target="_blank">
        <figure class="my-5 absolute bottom-1 right-4">
          <img src="@/../../public/images/logo.png" alt="Logo" />
        </figure>
        </a>
      </div>
      <p class="bg-[#1a1a1a] text-white px-3 pb-2">
        Copyright 2023. Emblems3dUSA todos los derechos reservados. Políticas de
        privacidad y administración de cookies
      </p>
    </footer>

    <!-- -------------- Modal starts----------------------- -->
        <DialogModal :show="discountUsedModal || discountNotFound" 
        @close="safeShippingModal = false; onTimeModal = false; discountUsedModal = false; discountNotFound = false">
                <template #title>
                    <p v-if="discountUsedModal"><i class="fa-solid fa-circle-exclamation text-red-600 mr-2"></i> Descuento utilizado</p>
                    <p v-else-if="discountNotFound"><i class="fa-solid fa-circle-exclamation text-red-600 mr-2"></i> Código inválido</p>
                </template>
                <template #content>
                    <p v-if="discountUsedModal">Ya has utilizado un código de descuento. Si quieres utilizar otro código diferente favor de refrescar la página</p>
                    <p v-else-if="discountNotFound">No se encontró ningún código de descuento válido. Tal vez ha expirado o lo escribiste mal.</p>
                </template>
                <template #footer>
                    <CancelButton @click="discountUsedModal = false; discountNotFound = false">
                        Cerrar</CancelButton>
                </template>
            </DialogModal>
            <!-- --------------------------- Modal ends ------------------------------------ -->
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ThirthButton from "@/Components/MyComponents/ThirthButton.vue";
import ProductCard from "@/Components/MyComponents/ProductCard.vue";
import CartProductCard from "@/Components/MyComponents/CartProductCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import DialogModal from "@/Components/DialogModal.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import { Link, useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      key_ring: false,
    });

    return {
      form,
      discount_code: null,
      discount_Object: null,
      discount: 0,
      subtotal_mounted: 0,
      shipping_cost: 0,
      total: 0,
      discount_used: false,
      discountUsedModal: false,
      discountNotFound: false,
    };
  },
  props: {
    cart_products: Array,
    discounts: Array,
    subtotal: Number,
  },
  components: {
    AppLayout,
    ThirthButton,
    Checkbox,
    PrimaryButton,
    DialogModal,
    CancelButton,
    ProductCard,
    CartProductCard,
    Link,
  },
  methods: {
    apllyDiscount(){
      if(!this.discount_used){

        this.discount_Object = this.discounts.find(discount => discount.code === this.discount_code);

     if(this.discount_Object != null){
       if(this.discount_Object.is_percentage){
         this.discount = (this.discount_Object.discount / 100) * this.subtotal;
      }
      this.discount = this.discount_Object.discount;
       this.discount_used = true;
     }else{
      this.discountNotFound = true;
     }
     this.total = this.subtotal_mounted + this.shipping_cost - this.discount;
        }else{
          this.discountUsedModal = true;
        }
    }
  },
  mounted(){
    this.subtotal_mounted = this.subtotal;
    if(this.subtotal < 500){
      this.shipping_cost = 150;
    }else{
      this.shipping_cost = 0;
    }
    this.total = this.subtotal_mounted + this.shipping_cost - this.discount;
  },
};
</script>

<style></style>

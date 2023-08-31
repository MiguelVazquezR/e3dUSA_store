<template>
  <AppLayout>
    <div class="lg:px-20 lg:py-8">

        <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2">
        <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('products.index'))" class="cursor-pointer text-primary">Productos</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('carts.index'))" class="cursor-pointer text-primary">Carrito</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p>Verifica tu pedido</p>
      </div>

        <h2 class="text-secondary ml-7 my-3">Selecciona la dirección del envío</h2>

        <div class="lg:flex space-x-12">
        <!-- --------------------- Address' section -------------------  -->
        <div class="lg:w-2/3 px-2">
          <AddressCard v-for="address in addresses" :key="address" :address="address" />
            <p @click="$inertia.get(route('addresses.create'))" class="text-primary cursor-pointer"><i class="fa-solid fa-plus"></i> Añadir otra dirección</p>


<!-- ----------------- table cart products detail ------------------- -->
                <h2 class="text-secondary ml-7 mb-3 mt-14">Detalle del pedido</h2>
            <div class="mx-10">
                <table class="default">

                <tr>
                    <th class="px-4 py-2"></th>
                    <th class="px-4 py-2">Cantidad</th>
                    <th class="px-4 py-2">Precio</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
                <tr v-for="product_detail in cart_products" :key="product_detail">
                    <td class="py-2">
                        <div class="flex space-x-4">
                            <div class="w-36 h-24 rounded-lg border"></div>
                            <div class="text-sm">
                                <p class="font-bold">{{ product_detail.product.name }}</p>
                                <p>Marca: {{ product_detail.product.brand }}</p>
                                <p>Modelo: {{ product_detail.product.model }}</p>
                                <p>Características: {{ product_detail.product.features }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-center px-4 py-2">{{product_detail.quantity.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</td>
                    <td class="text-center px-4 py-2">${{ product_detail.product.price.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</td>
                    <td class="text-center text-secondary font-bold px-4 py-2">${{ (product_detail.quantity * product_detail.product.price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</td>

                </tr>

                </table>
            </div>
<!-- ----------------- table cart products detail ------------------- -->
        </div>


        <!-- ------------------ Total payment section ------------ -->
        <div class="w-1/3">
            <h2 class="text-secondary ml-7 my-3">Elige la fecha de entrega</h2>
            
          <div class="border border-[#9A9A9A] rounded-lg p-5 flex flex-col space-y-2">
            
          </div>

          <div class="border border-[#9A9A9A] rounded-lg p-5 flex flex-col space-y-2 mt-12 mb-2">
            <div class="flex justify-between">
              <p class="font-bold text-sm">Subtotal:</p>
              <p class="text-sm">
                ${{ 'subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")' }}
              </p>
            </div>
            <div class="flex justify-between">
              <p class="font-bold text-sm">Costo de envío:</p>
              <p class="text-sm">${{ 'shipping_cost' }}</p>
            </div>
            <div class="flex justify-between">
              <p class="font-bold text-primary text-sm">Descuento:</p>
              <p class="text-sm text-primary">
                ${{ 'discount.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")' }}
              </p>
            </div>
            <div class="flex justify-between">
              <p class="font-bold text-sm text-secondary">Total:</p>
              <p class="text-sm text-secondary">
                ${{ 'total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")' }}
              </p>
            </div>
            <label class="flex items-rig justify-end">
              <Checkbox />
              <span class="ml-2 text-xs text-gray-600">Solicitar factura</span>
            </label>
          </div>

          <div class="text-center">
            <PrimaryButton
              @click="$inertia.get(route('carts.payment-verification'))"
              class="!px-24"
              >Ir al pago</PrimaryButton
            >
          </div>

        </div>
      </div>

    </div>



  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AddressCard from "@/Components/MyComponents/AddressCard.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Link, useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      key_ring: false,
    });

    return {
      form,
 
    };
  },
  props: {
    addresses: Array,
    cart_products: Array,
  },
  components: {
    AppLayout,
    PrimaryButton,
    AddressCard,
    Checkbox,
    Link,
  },
  methods: {
    
  },
};
</script>


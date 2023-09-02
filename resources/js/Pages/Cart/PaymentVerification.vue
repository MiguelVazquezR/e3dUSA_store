<template>
  <AppLayout>
    <div class="lg:px-20 lg:py-12">

        <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2 text-sm">
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
              <Checkbox v-model:checked="has_invoice" />
              <span class="ml-2 text-xs text-gray-600">Solicitar factura</span>
            </label>
            <p @click="invoiceModal = true" v-if="has_invoice" class="text-xs text-primary text-center cursor-pointer pt-3">+ Agregar datos de facturación</p>
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

<!-- -------------- Invoice modal starts----------------------- -->
      <Modal :show="invoiceModal " @close="invoiceModal = false">
        <form @submit.prevent="storeInvoice" class="mx-7 my-4 space-y-4 relative px-3">
            <div @click="invoiceModal = false"
                class="cursor-pointer w-5 h-5 rounded-full border-2 border-black flex items-center justify-center absolute top-0 right-0">
                <i class="fa-solid fa-xmark"></i>
              </div>
          <h2 class="text-center">Datos de facturación</h2> 

          <div class="flex justify-center border-b border-[#9A9A9A] w-1/2 mx-auto">
            <p @click="invoiceTab = 1" :class="invoiceTab == 1 ? 'border-b-2 border-[#D90537]' : ''" class="text-[#9A9A9A] px-4 cursor-pointer">Persona física</p>
            <p @click="invoiceTab = 2" :class="invoiceTab == 2 ? 'border-b-2 border-[#D90537]' : ''" class="text-[#9A9A9A] px-4 cursor-pointer">Persona moral</p>
          </div>

          <!-- ---------------- Persona fisica ----------- -->
            <div v-if="invoiceTab == 1" class="flex space-x-1 pt-5">
                  <InputWithPlaceholder v-model="form.name">Nombre(s) *</InputWithPlaceholder>
                  <InputError :message="form.errors.name" />
                  <InputWithPlaceholder v-model="form.patern_last_name">Apellido paterno *</InputWithPlaceholder>
                  <InputError :message="form.errors.patern_last_name" />
                  <InputWithPlaceholder v-model="form.mother_last_name">Apellido materno *</InputWithPlaceholder>
                  <InputError :message="form.errors.mother_last_name" />
            </div>
            <div v-if="invoiceTab == 1" class="flex space-x-1">
                  <InputWithPlaceholder v-model="form.rfc">RFC *</InputWithPlaceholder>
                  <InputError :message="form.errors.rfc" />
                  <select class="input" v-model="form.tax_regime">
                    <option selected disabled>--- Régimen fiscal ---</option>
                    <option v-for="tax_regime in tax_regimes" :key="tax_regime" :value="tax_regime">{{ tax_regime }}</option>
                  </select>
                  <InputError :message="form.errors.tax_regime" />
            </div>
                  <select class="input w-1/2" v-model="form.tax_regime">
                    <option selected disabled>--- Uso de CFDI ---</option>
                    <option v-for="tax_regime in tax_regimes" :key="tax_regime" :value="tax_regime">{{ tax_regime }}</option>
                  </select>
                  <InputError :message="form.errors.tax_regime" />

                  <h3 class="text-secondary">Dirección Fiscal</h3>
          

          <!-- -------- Buttons ----- -->
          <div class="flex justify-end space-x-3 pt-5 pb-1">
            <PrimaryButton>Aceptar</PrimaryButton>
            <CancelButton @click="invoiceModal = false">Cancelar</CancelButton>
          </div>
        </form>
      </Modal>

  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AddressCard from "@/Components/MyComponents/AddressCard.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Modal from "@/Components/Modal.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";
import InputError from "@/Components/InputError.vue";
import { Link, useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      name: null,
      patern_last_name: null,
      mother_last_name: null,
      rfc: null,
      tax_regime: null,
      cfdi_use: null,
      postal_code: null,
      street: null,
      outdoor_number: null,
      interior_number: null,
      colony: null,
      city_halll: null,
      city: null,
      state: null,
      email: null,
      phone: null,
    });

    return {
      form,
      has_invoice: false,
      invoiceModal: false,
      invoiceTab: 1,
      tax_regimes: [
        'Régimen Simplificado de Confianza',
        'Sueldos y salarios e ingresos asimilados a salarios',
        'Régimen de Actividades Empresariales y Profesionales',
        'Régimen de Incorporación Fiscal',
        'Enajenación de bienes',
        'Régimen de Actividades Empresariales con ingresos a través de Plataformas Tecnológicas',
        'Régimen de Arrendamiento',
        'Intereses',
        'Obtención de premios',
        'Dividendos',
        'Demás ingresos',
      ],
 
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
    Modal,
    CancelButton,
    InputWithPlaceholder,
    InputError,
    Link,
  },
  methods: {
    
  },
};
</script>


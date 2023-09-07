<template>
  <AppLayout>
    <div class="lg:px-20 lg:py-12 pb-20">

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

        <div class="lg:flex lg:space-x-12">
        <!-- --------------------- Address' section -------------------  -->
        <div class="lg:w-2/3 px-2">
          <AddressCard v-for="address in addresses" :key="address" :address="address" />
            <p @click="$inertia.get(route('addresses.create'))" class="text-primary cursor-pointer"><i class="fa-solid fa-plus"></i> Añadir otra dirección</p>


<!-- ----------------- table cart products detail ------------------- -->
                <h2 class="text-secondary ml-7 mb-3 mt-14">Detalle del pedido</h2>
            <div class="mx-10 hidden lg:block">
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

<!-- ----------------- responsive cart products detail ------------------- -->
<section class="lg:hidden">
          <div v-for="product_detail in cart_products" :key="product_detail" class="text-xs">
            <div class="p-5 flex space-x-3">
              <figure @click="$inertia.get(route('products.show', product_detail.product?.id))" class="bg-[#D9D9D9] w-28 h-24 rounded-md">
                <img src="" alt="">
              </figure>
              <div>
                <p @click="$inertia.get(route('products.show', product_detail.product?.id))" class="cursor-pointer font-bold">{{ product_detail.product.name }}</p>
                <p>Marca: {{ product_detail.product.brand }}</p>
                <p>Modelo: {{ product_detail.product.model }}</p>
                <p>Características: {{ product_detail.product.features }}</p>
                <p>Precio: ${{ product_detail.product?.price?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")  }}</p>
                <div class="flex justify-between">
                  <p class="font-bold text-sm">Total: ${{ (product_detail.quantity * product_detail.product.price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</p>
                  <p class="text-[#9A9A9A]">Cantidad: {{ product_detail.quantity }}</p>
                </div>
              </div>
            </div>
            <div class="border-b borer-[#9A9A9A] w-full mt-4"></div>
          </div>
</section>


        </div>


        <!-- ------------------ Total payment section ------------ -->
        <div class="lg:w-1/3 mx-2">
            <h2 class="text-secondary lg:ml-7 my-3">Elige la fecha de entrega</h2>
            
          <div class="border border-[#9A9A9A] rounded-lg p-5 flex flex-col space-y-2">
            
          </div>

          <div class="lg:border border-[#9A9A9A] rounded-lg p-5 flex flex-col space-y-2 mt-6 lg:mt-12 mb-2">
            <div class="flex justify-between">
              <p class="font-bold text-sm">Subtotal:</p>
              <p class="text-sm">
                ${{ subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
              </p>
            </div>
            <div class="flex justify-between">
              <p class="font-bold text-sm">Costo de envío:</p>
              <p class="text-sm">${{ shipping_cost.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</p>
            </div>
            <div class="flex justify-between">
              <p class="font-bold text-primary text-sm">Descuento:</p>
              <p class="text-sm text-primary">
                ${{ discount?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") ?? 0 }}
              </p>
              {{discount_object}}
            </div>
            <div class="flex justify-between">
              <p class="font-bold text-sm text-secondary">Total:</p>
              <p class="text-sm text-secondary">
                ${{ total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
              </p>
            </div>
            <label class="flex items-rig justify-end">
              <Checkbox v-model:checked="has_invoice" />
              <span class="ml-2 text-xs text-gray-600">Solicitar factura</span>
            </label>
            <div class="flex flex-col space-y-1 pb-4" v-if="has_invoice">
              <label class="text-sm" v-for="invoice_info in invoices_info" :key="invoice_info" for="">
                <input v-model="invoice_to" type="radio" name="invoice">
                {{ invoice_info.rfc }} <i @click="itemToDelete = invoice_info; deleteConfirmModal = true" class="fa-solid fa-trash-can ml-2 text-primary cursor-pointer"></i>
              </label>
            </div>
              <p v-if="has_invoice" @click="invoiceModal = true" class="text-xs text-primary text-center cursor-pointer">+ Agregar datos de facturación</p>
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
        <form @submit.prevent="storeInvoice" class="mx-2 lg:mx-7 my-4 space-y-4 relative lg:px-3 text-sm lg:text-base">
            <div @click="invoiceModal = false"
                class="cursor-pointer w-5 h-5 rounded-full border-2 border-black flex items-center justify-center absolute top-0 right-0">
                <i class="fa-solid fa-xmark"></i>
              </div>
          <h2 class="text-center">Datos de facturación</h2> 

          <div class="flex justify-center border-b border-[#9A9A9A] mx-7 lg:w-1/2 lg:mx-auto text-center">
            <p @click="invoiceTab = 1" :class="invoiceTab == 1 ? 'border-b-2 border-[#D90537]' : ''" class="text-[#9A9A9A] px-4 cursor-pointer">Persona física</p>
            <p @click="invoiceTab = 2" :class="invoiceTab == 2 ? 'border-b-2 border-[#D90537]' : ''" class="text-[#9A9A9A] px-4 cursor-pointer">Persona moral</p>
          </div>

          <!-- ---------------- Persona fisica ----------- -->

            <div v-if="invoiceTab == 1" class="lg:flex space-y-2 space-x-1 pt-5">
                  <InputWithPlaceholder v-model="form.name">Nombre(s) *</InputWithPlaceholder>
                  <InputError :message="form.errors.name" />
                  <InputWithPlaceholder v-model="form.patern_last_name">Apellido paterno *</InputWithPlaceholder>
                  <InputError :message="form.errors.patern_last_name" />
                  <InputWithPlaceholder v-model="form.mother_last_name">Apellido materno *</InputWithPlaceholder>
                  <InputError :message="form.errors.mother_last_name" />
            </div>

            <div v-if="invoiceTab == 2" class="flex space-x-1 pt-5">
                  <select class="input" v-model="form.tax_regime">
                    <option selected disabled>--- Razon Social ---</option>
                    <option v-for="tax_regime in tax_regimes" :key="tax_regime" :value="tax_regime">{{ tax_regime }}</option>
                  </select>
            </div>
          
            <div class="flex space-x-1">
                  <InputWithPlaceholder v-model="form.rfc">RFC *</InputWithPlaceholder>
                  <InputError :message="form.errors.rfc" />
                  <select class="input" v-model="form.tax_regime">
                    <option selected disabled>--- Régimen fiscal ---</option>
                    <option v-for="tax_regime in tax_regimes" :key="tax_regime" :value="tax_regime">{{ tax_regime }}</option>
                  </select>
                  <InputError :message="form.errors.tax_regime" />
            </div>
                  <select class="input lg:w-1/2" v-model="form.cfdi_use">
                    <option selected disabled>--- Uso de CFDI ---</option>
                    <option v-for="tax_regime in tax_regimes" :key="tax_regime" :value="tax_regime">{{ tax_regime }}</option>
                  </select>
                  <InputError :message="form.errors.cfdi_use" />

                  <h3 class="text-secondary pt-5">Dirección Fiscal</h3>

                  <div class="lg:flex space-y-2 space-x-1">
                    <InputWithPlaceholder v-model="form.postal_code">Código postal *</InputWithPlaceholder>
                    <InputError :message="form.errors.postal_code" />
                    <InputWithPlaceholder v-model="form.street">Calle *</InputWithPlaceholder>
                    <InputError :message="form.errors.street" />
                    <InputWithPlaceholder v-model="form.outdoor_number">N° exterior *</InputWithPlaceholder>
                    <InputError :message="form.errors.outdoor_number" />
                    <InputWithPlaceholder v-model="form.interior_number">N° interior</InputWithPlaceholder>
                    <InputError :message="form.errors.interior_number" />
                  </div>

                  <div class="flex space-x-1">
                    <InputWithPlaceholder v-model="form.colony">Colonia *</InputWithPlaceholder>
                    <InputError :message="form.errors.colony" />
                    <InputWithPlaceholder v-model="form.city_halll">Municipio *</InputWithPlaceholder>
                    <InputError :message="form.errors.city_halll" />
                  </div>

                  <div class="flex space-x-1">
                    <InputWithPlaceholder v-model="form.city">Ciudad *</InputWithPlaceholder>
                    <InputError :message="form.errors.city" />
                    <InputWithPlaceholder v-model="form.state">Estado *</InputWithPlaceholder>
                    <InputError :message="form.errors.state" />
                  </div>

                  <h3 class="text-secondary pt-5">Otros datos</h3>

                  <div class="flex space-x-1">
                    <InputWithPlaceholder v-model="form.email">Correo electrónico</InputWithPlaceholder>
                    <InputError :message="form.errors.email" />
                    <InputWithPlaceholder v-model="form.phone">Teléfono</InputWithPlaceholder>
                    <InputError :message="form.errors.phone" />
                  </div>
          

          <!-- -------- Buttons ----- -->
          <div class="flex justify-end space-x-3 pt-5 pb-1">
            <PrimaryButton :disabled="form.processing">Aceptar</PrimaryButton>
            <CancelButton @click="invoiceModal = false">Cancelar</CancelButton>
          </div>
        </form>
      </Modal>

<!-- ------------- Confirmaion modal -------------- -->
  <ConfirmationModal :show="deleteConfirmModal" @close="deleteConfirmModal = false">
      <template #title>
        <p>¿Deseas continua?</p>
      </template>

      <template #content>
        <p>Estas a punto de eliminar el elemento. Si lo eliminas ya no podrás recuperarlo. ¿Deseas continuar?</p>
      </template>

      <template #footer>
        <div class="flex space-x-2">
          <PrimaryButton @click="deleteItem">Eliminar</PrimaryButton>
            <CancelButton @click="deleteConfirmModal = false">Cancelar</CancelButton>
        </div>
      </template>

  </ConfirmationModal>

  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AddressCard from "@/Components/MyComponents/AddressCard.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Modal from "@/Components/Modal.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
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
      deleteConfirmModal: false,
      itemToDelete: false,
      invoiceTab: 1,
      invoice_to: null,
      shipping_cost: 0,
      discount: 0,
      total: 0,
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
    invoices_info: Array,
    subtotal: Number,
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
    ConfirmationModal,
    Link,
  },
  methods: {
    storeInvoice(){
      this.form.post(route('invoices.store'));
    },
    deleteItem(){
      this.$inertia.delete(route('invoices.destroy', this.itemToDelete.id));
      this.deleteConfirmModal = false;
    },
  },
  mounted() {
    // this.discount = this.discount_object?.discount;
    if (this.subtotal < 500) {
      this.shipping_cost = 150;
    } else {
      this.shipping_cost = 0;
    }
    this.total = this.subtotal + this.shipping_cost - this.discount;
  },
};
</script>


<template>
  <AppLayout>
    <div class="lg:px-10 lg:py-8 pb-20">
      <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2 text-sm">
        <i
          @click="$inertia.get('/dashboard')"
          class="fa-solid fa-house text-primary cursor-pointer"
        ></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p
          @click="$inertia.get(route('products.index'))"
          class="cursor-pointer text-primary"
        >
          Productos
        </p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p>Carrito</p>
      </div>

<!-- ------------------------ Large screen view starts ------------------------ -->
<section class="hidden lg:block">
      <h2 class="text-secondary ml-7 my-3">Productos</h2>

      <div class="flex space-x-5">
        <!-- --------------------- Products' cart section -------------------  -->
        <div class="border border-[#9A9A9A] rounded-lg w-2/3 p-5">
          <!-- ------ product cart component ------ -->
          <div v-if="cart_products.length" >

          <CartProductCard
            v-for="cart_product in cart_products"
            :key="cart_product"
            :cart_product="cart_product"
          />
          </div>
          <!-- ------ product cart component end ------ -->
          <div v-else>
          <p class="text-sm text-gray-500 text-center">No hay productos en tu carrito</p>
        </div>
        </div>
        

        <!-- ------------------ Total payment section ------------ -->
        <div class="w-1/3">
          <div class="border border-[#9A9A9A] rounded-lg p-5 flex flex-col space-y-2">
            <div class="flex justify-between">
              <p class="font-bold text-sm">Subtotal:</p>
              <p class="text-sm">
                ${{ subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
              </p>
            </div>
            <div class="flex justify-between">
              <p class="font-bold text-sm">Costo de envío:</p>
              <p class="text-sm">${{ shipping_cost }}</p>
            </div>
            <div class="flex justify-between">
              <p class="font-bold text-primary text-sm">Descuento:</p>
              <p class="text-sm text-primary">
                ${{ discount.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
              </p>
            </div>
            <div class="flex justify-between">
              <p class="font-bold text-sm text-secondary">Total:</p>
              <p class="text-sm text-secondary">
                ${{ total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
              </p>
            </div>
          </div>
          <p class="text-secondary text-xs mt-2 mb-5">
            *El pedido debe solicitarse con al menos una semana de anticipación
          </p>
          <div class="text-center">
            <PrimaryButton
              @click="$inertia.get(route('carts.payment-verification'))"
              class="px-24"
              >Continuar</PrimaryButton
            >
          </div>
          <h2 class="text-secondary ml-7 my-4 mb-3">Cupón de descuento</h2>
          <div class="w-full flex space-x-3">
            <input
              v-model="discount_code"
              type="text"
              class="input"
              placeholder="Ingresa un cupón de descuento"
            />
            <PrimaryButton @click="apllyDiscount">Aplicar</PrimaryButton>
          </div>
        </div>
      </div>
</section>
<!-- ------------------------ Large screen view ends ------------------------ -->


<!-- ------------------------ responsive screen view starts ------------------------ -->
<section class="lg:hidden px-6">
  <div>
    <CartProductCard
            v-for="cart_product in cart_products"
            :key="cart_product"
            :cart_product="cart_product"
          />
  </div>

  <div>
    <h2 class="text-secondary my-3">Cupón de descuento</h2>
    <div class="w-full flex space-x-3">
      <input
        v-model="discount_code"
        type="text"
        class="input"
        placeholder="Ingresa un cupón de descuento"
      />
      <PrimaryButton @click="apllyDiscount">Aplicar</PrimaryButton>
    </div>
  </div>

  <div class="mt-5">
    <div class="flex justify-between">
      <p class="font-bold text-sm">Subtotal:</p>
      <p class="text-sm">
        ${{ subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
      </p>
    </div>
    <div class="flex justify-between">
      <p class="font-bold text-sm">Costo de envío:</p>
      <p class="text-sm">${{ shipping_cost }}</p>
    </div>
    <div class="flex justify-between">
      <p class="font-bold text-primary text-sm">Descuento:</p>
      <p class="text-sm text-primary">
        ${{ discount.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
      </p>
    </div>
    <div class="flex justify-between">
      <p class="font-bold text-sm text-secondary">Total:</p>
      <p class="text-sm text-secondary">
        ${{ total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
      </p>
    </div>
  </div>
  <p class="text-secondary text-center text-xs mt-2 mb-5">
            *El pedido debe solicitarse con al menos una semana de anticipación
          </p>
          <div class="text-center">
            <PrimaryButton
              @click="$inertia.get(route('carts.payment-verification'))"
              class="px-24"
              >Continuar</PrimaryButton
            >
          </div>
</section>
<!-- ------------------------ responsive screen view ends ------------------------ -->


      <ThirthButton
        @click="$inertia.get(route('products.index'))"
        class="border-[#D90537] !text-primary ml-6 mt-9"
        >Seguir comprando</ThirthButton
      >
    </div>

    <!-- -------------- Modal starts----------------------- -->
    <DialogModal
      :show="discountUsedModal || discountNotFound"
      @close="
        safeShippingModal = false;
        onTimeModal = false;
        discountUsedModal = false;
        discountNotFound = false;
      "
    >
      <template #title>
        <p v-if="discountUsedModal">
          <i class="fa-solid fa-circle-exclamation text-red-600 mr-2"></i> Descuento
          utilizado
        </p>
        <p v-else-if="discountNotFound">
          <i class="fa-solid fa-circle-exclamation text-red-600 mr-2"></i> Código inválido
        </p>
      </template>
      <template #content>
        <p v-if="discountUsedModal">
          Ya has utilizado un código de descuento. Si quieres utilizar otro código
          diferente favor de refrescar la página
        </p>
        <p v-else-if="discountNotFound">
          No se encontró ningún código de descuento válido. Tal vez ha expirado o lo
          escribiste mal.
        </p>
      </template>
      <template #footer>
        <CancelButton
          @click="
            discountUsedModal = false;
            discountNotFound = false;
          "
        >
          Cerrar</CancelButton
        >
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
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {
      discount_code: null,
      discount_object: null,
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
    apllyDiscount() {
      //discount coede already not used?
      if (!this.discount_used) {
        this.discount_object = this.discounts.find(
          (discount) => discount.code === this.discount_code
        );

        //discount found
        if (this.discount_object != null) {
          // type of discpunt. percentage?
          if (this.discount_object.is_percentage == 1) {
            this.discount = (this.discount_object.discount / 100) * this.subtotal;
          } else {
            this.discount = this.discount_object.discount;
          }
          this.discount_used = true;
        } else {
          this.discountNotFound = true;
        }
        this.total = this.subtotal_mounted + this.shipping_cost - this.discount;
      } else {
        this.discountUsedModal = true;
      }
    },
  },
  mounted() {
    this.subtotal_mounted = this.subtotal;
    if (this.subtotal < 500) {
      this.shipping_cost = 150;
    } else {
      this.shipping_cost = 0;
    }
    this.total = this.subtotal_mounted + this.shipping_cost - this.discount;
  },
};
</script>

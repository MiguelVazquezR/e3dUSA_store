<template>
  <div class="border border-[#9a9a9a] rounded-lg flex flex-col justify-center lg:text-sm text-xs lg:h-[500px] relative">
    <div @click="$inertia.get(route('products.show', product.id))" class="bg-[#D9D9D9] h-56 rounded-t-lg cursor-pointer">
      <figure class="h-full">
        <img :src="cover" alt="portada" class="object-contain bg-no-repeat w-64 h-44">
      </figure>
    </div>
    <div class="flex flex-col mt-1 px-3 lg:px-6 h-4/5 text-center">
      <h2 class="font-bold text-center">{{ product.name }}</h2>
      <p>{{ product.description }}</p>
      <div class="flex justify-center space-x-1">
        <p class="text-center">{{ product.features }}</p>
      </div>
      <p>SKU: {{ product.part_number }}</p>
      <div :class="(product.price * quantity) > 500 ? 'text-green-500' : ''"
        class="flex items-center space-x-2 justify-center">
        <i class="fa-solid fa-truck-fast"></i>
        <p>{{ (product.price * quantity) < 500 ? "Costo de envío $150.00" : 'Gratis' }}</p>
      </div>
      <div class="border-b boder-[#9a9a9a] my-2"></div>
    </div>

    <p v-if="product.discount" class="text-sm line-through text-center mb-1">${{ (product.price *
      quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</p>
    <h1 :class="product.discount ? 'text-primary' : 'text-secondary'" class="text-3xl font-bold text-center">
      ${{ product?.is_percentage ? ((product?.price * (100 - product?.discount) * 0.01) *
        quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        : (product?.price - product?.discount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      }}

    </h1>

    <div class="border border-[#9a9a9a] rounded-full w-20 py-1 grid grid-cols-3 px-2 mx-auto mb-9">
      <span @click="quantity != 1 ? quantity -= 1 : ''" class="text-left text-secondary font-bold cursor-pointer">-</span>
      <span class="text-center">{{ quantity }}</span>
      <span @click="quantity += 1" class="text-right text-secondary font-bold cursor-pointer">+</span>
    </div>
    <div class="mx-auto mb-4">
      <PrimaryButton @click="addCartProduct" class="px-12" :disabled="loading">Agregar</PrimaryButton>
    </div>
    <i v-if="product.discount" class="fa-solid fa-certificate text-primary text-6xl absolute -top-3 -right-3"></i>
    <p v-if="product.discount" class="text-white font-bold absolute top-2 right-1  text-sm">-{{ product.is_percentage ?
      '%' + product.discount : '$' + product.discount }}</p>
  </div>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import axios from "axios";

export default {
  data() {

    return {
      quantity: 1,
      loading: false,
      cover: null,
    }
  },
  components: {
    PrimaryButton,
  },
  props: {
    product: Array,
  },
  methods: {
    // async addCartProduct() {
    //   try {
    //     this.loading = true;
    //     const response = await axios.post(route('cart-products.store', { 'product': this.product, 'quantity': this.quantity }));

    //     if (response.status === 200) {
    //       this.$notify({
    //         title: 'Correcto',
    //         message: response.data.message,
    //         type: 'success'
    //       });
    //     }
    //   } catch (error) {
    //     console.log(error);
    //   } finally {
    //     this.loading = false;
    //   }
    // }

    addCartProduct() {
      this.$inertia.post(route('cart-products.store', { 'product': this.product, 'quantity': this.quantity }));
      this.$notify({
        title: 'Correcto',
        message: "Se guardó producto en carrito",
        type: 'success'
      });
    }
  },
  mounted() {
    this.cover = this.product.media.find(item => item.collection_name == 'cover').original_url;
  }
}
</script>

<style></style>
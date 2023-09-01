<template>
  <div class="border border-[#9a9a9a] rounded-lg flex flex-col justify-center text-sm lg:h-[500px]">
              <div @click="$inertia.get(route('products.show', product.id))" class="bg-[#D9D9D9] h-full rounded-t-lg cursor-pointer relative">
                <figure>
                  <img src="" alt="image">
                </figure>
                <i @click="$inertia.get(route('products.edit', product.id))" class="fa-solid fa-pen text-sm text-primary font-bold rounded-full absolute top-0 right-0 bg-[#CCCCCC] py-1 px-2 cursor-pointer hover:scale-110 z-100"></i>
              </div>
              <div class="flex flex-col mt-1 px-6 h-4/5 text-center">
                <h2 class="font-bold text-center">{{ product.name }}</h2>
                <p>{{product.description}}</p>
                <div class="flex justify-center space-x-1">
                  <p class="text-center">{{product.features}}</p>
                </div>
                <p>SKU: {{ product.part_number }}</p>
                <div :class=" (product.price * quantity) > 500 ? 'text-green-500' : '' " class="flex items-center space-x-2 justify-center">
                  <i class="fa-solid fa-truck-fast"></i>
                  <p>{{(product.price * quantity) < 500 ? "Costo de envío $150.00" : 'Gratis'}}</p>
                </div>
                <div class="border-b boder-[#9a9a9a] my-2"></div>
              </div>
              
              <h1 class="text-3xl text-secondary font-bold text-center">${{ (product.price * quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</h1>

              <div class="border border-[#9a9a9a] rounded-full w-20 py-1 grid grid-cols-3 px-2 mx-auto mb-9">
                <span @click="quantity != 1 ? quantity -= 1 : ''" class="text-left text-secondary font-bold cursor-pointer">-</span>
                <span class="text-center">{{quantity}}</span>
                <span @click="quantity += 1" class="text-right text-secondary font-bold cursor-pointer">+</span>
              </div>

                <div class="mx-auto mb-4">
              <PrimaryButton @click="addCartProduct" class="px-12">Agregar</PrimaryButton>
                </div>

            </div>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
data(){

    return{
        quantity: 1,
    }
},
components:{
    PrimaryButton,
},
props:{
    product: Object
},
methods:{
  addCartProduct(){
    console.log('agregar a carrito', this.product);
    this.$inertia.post(route('cart-products.store', {'product': this.product, 'quantity': this.quantity }));
  }
},
}
</script>

<style>

</style>
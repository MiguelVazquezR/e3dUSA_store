<template>
  <div class="border border-[#9a9a9a] rounded-lg flex flex-col justify-center text-sm lg:h-[435px]">
              <div @click="$inertia.get(route('products.show', product.id))" class="bg-[#D9D9D9] py-2 h-1/3 rounded-lg cursor-pointer">
                <figure>
                  <img src="" alt="image">
                </figure>
              </div>
              <div class="flex flex-col mt-1 px-6 text-center">
                <h2 class="font-bold text-center">{{ product.name }}</h2>
                <p>{{product.description}}</p>
                <div class="flex space-x-1">
                  <p class="text-center" v-for="feature in product.features" :key="feature">{{feature}},</p>
                </div>
                <p>SKU:240N</p>
                <div class="border-b boder-[#9a9a9a] my-2"></div>
              </div>

              <h1 class="text-3xl text-secondary font-bold text-center">${{ product.price }}</h1>

              <div class="border border-[#9a9a9a] rounded-full w-20 py-1 grid grid-cols-3 px-2 mx-auto my-4">
                <span @click="quantity != 1 ? quantity -= 1 : ''" class="text-left text-secondary font-bold cursor-pointer">-</span>
                <span class="text-center">{{quantity}}</span>
                <span @click="quantity += 1" class="text-right text-secondary font-bold cursor-pointer">+</span>
              </div>

                <div class="mx-auto">
              <PrimaryButton class="px-12">Agregar</PrimaryButton>
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

},
}
</script>

<style>

</style>
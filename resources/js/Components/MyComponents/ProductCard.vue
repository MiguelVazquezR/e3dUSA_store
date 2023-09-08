<template>
  <div class="border border-[#9a9a9a] rounded-lg flex flex-col justify-center lg:text-sm text-xs lg:h-[500px] relative">
              <div @click="$inertia.get(route('products.show', product.id))" class="bg-[#D9D9D9] h-full rounded-t-lg cursor-pointer">
                <figure>
                  <img class="bg-cover bg-no-repeat" src="product.media[0]?.original_url" alt="Cover image">
                </figure>
              </div>
              <div class="flex flex-col mt-1 px-3 lg:px-6 h-4/5 text-center">
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
              
              <p v-if="product.discount" class="text-sm line-through text-center mb-1">${{ (product.price * quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</p>
              <h1 :class="product.discount ? 'text-primary' : 'text-secondary' " class="text-3xl font-bold text-center">
                ${{product?.is_percentage ? ((product?.price * (100 - product?.discount) * 0.01) * quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            : (product?.price - product?.discount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }}

              </h1>

              <div class="border border-[#9a9a9a] rounded-full w-20 py-1 grid grid-cols-3 px-2 mx-auto mb-9">
                <span @click="quantity != 1 ? quantity -= 1 : ''" class="text-left text-secondary font-bold cursor-pointer">-</span>
                <span class="text-center">{{quantity}}</span>
                <span @click="quantity += 1" class="text-right text-secondary font-bold cursor-pointer">+</span>
              </div>

                <div class="mx-auto mb-4">
              <PrimaryButton @click="addCartProduct" class="px-12">Agregar</PrimaryButton>
                </div>
                <i v-if="$page.props.auth.user.is_admin" @click="$inertia.get(route('products.edit', product.id))" class="fa-solid fa-pen text-sm text-primary font-bold rounded-full absolute bottom-2 right-2 bg-[#CCCCCC] py-1 px-2 cursor-pointer hover:scale-110 z-100"></i>
                <i v-if="product.discount" class="fa-solid fa-certificate text-primary text-6xl absolute -top-3 -right-3"></i>
                <p v-if="product.discount" class="text-white font-bold absolute top-2 right-1  text-sm">-{{ product.is_percentage ? '%' + product.discount : '$' + product.discount }}</p>
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
    this.$inertia.post(route('cart-products.store', {'product': this.product, 'quantity': this.quantity }));
  }
},
}
</script>

<style>

</style>
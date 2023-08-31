<template>
  <div class="flex justify-between">
                  <div class="flex space-x-4">
                    <div @click="$inertia.get(route('products.show', cart_product.product?.id))" class="w-40 h-28 rounded-lg border cursor-pointer"></div>
                      <div >
                        <p @click="$inertia.get(route('products.show', cart_product.product?.id))" class="cursor-pointer font-bold">{{ cart_product.product.name }}</p>
                        <p>Marca: {{ cart_product.product.brand }}</p>
                        <p>Modelo: {{ cart_product.product.model }}</p>
                        <p>Características: {{ cart_product.product.features }}</p>
                      </div>
                  </div>
                  <div class="flex space-x-4 mr-14">
                      <div class="text-center space-y-3">
                        <p>Precio: ${{ cart_product.product?.price?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")  }}</p>
                        <div class="flex items-center space-x-4 my-4">
                          <p class="font-bold text-sm">Cantidad:</p>
                          <input v-model="form.quantity" type="number" min="1" class="input w-20 h-6 bg-[#D9D9D9] border border-transparent rounded-xl">
                        </div>
                        <p class="text-secondary">Total: ${{ (cart_product.product?.price * form.quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</p>
                      </div>
                  </div>
                </div>
                <div class="flex items-center mt-4 ml-5 text-sm text-gray-600">
                  <p class="cursor-pointer"><i class="fa-solid fa-trash-can mr-2"></i>Eliminar</p>
                  <div class="border-r-2 border-[9a9a9a] h-6 mx-3 "></div>
                  <p class="cursor-pointer">Guardad para después</p>
                </div>
                <div class="border-b borer-[#9A9A9A] w-full my-7"></div>
</template>

<script>
import { Link, useForm } from "@inertiajs/vue3";

export default {
data(){
    const form = useForm({
      quantity: this.cart_product.quantity,
    });
    return{
form
    }
},
props:{
    cart_product: Object
},
components:{
    Link,
},
methods:{

},
}
</script>

<style>

</style>
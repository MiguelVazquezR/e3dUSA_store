<template>
  <div class="flex justify-between">
                  <div class="flex space-x-4">
                    <div class="w-40 h-28 rounded-lg border"></div>
                      <div >
                        <p>{{ cart_product.product.name }}</p>
                        <p>{{ cart_product.product.brand }}</p>
                        <p>{{ cart_product.product.model }}</p>
                      </div>
                  </div>
                  <div class="flex space-x-4 mr-14">
                      <div class="text-center space-y-3">
                        <p>Precio: ${{ '89.99' }}</p>
                        <div class="flex items-center space-x-4 my-4">
                          <p class="font-bold text-sm">Cantidad:</p>
                          <input v-model="form.quantity" type="number" min="1" class="input w-20 h-6 bg-[#D9D9D9] border border-transparent rounded-xl">
                        </div>
                        <p class="text-secondary">Total: ${{ '8,447.87' }}</p>
                      </div>
                  </div>
                </div>
                <div class="border-b borer-[#9a9a9a] w-full my-7"></div>
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
}
}
</script>

<style>

</style>
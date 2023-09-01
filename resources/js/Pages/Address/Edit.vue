<template>
  <AppLayout title="Editar dirección">

    <div class="lg:px-20 lg:py-8">

        <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2 text-sm">
        <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('products.index'))" class="cursor-pointer text-primary">Productos</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('carts.index'))" class="cursor-pointer text-primary">Carrito</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('carts.payment-verification'))" class="cursor-pointer text-primary">Verifica tu pedido</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p>Editar dirección</p>
      </div>

    </div>


  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
data(){
    return{

    }
},
components:{
    AppLayout,
},
props:{

},
methods:{

},
}
</script>

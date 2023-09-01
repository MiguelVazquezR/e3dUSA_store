<template>
  <AppLayout title="Nueva dirección">

    <div class="lg:px-20 lg:py-8">

        <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2">
        <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p>Historial de productos</p>
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

<style>

</style>
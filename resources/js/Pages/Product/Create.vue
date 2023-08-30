<template>
    <AppLayout>
      <div class="lg:px-8 lg:py-8">
        <!-- ---------------------- directory ------------------------ -->
        <div class="mb-8 flex space-x-2 items-center">
            <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
            <i class="fa-solid fa-angle-right text-primary"></i>
            <p @click="$inertia.get(route('products.index'))" class="cursor-pointer">Productos</p>
            <i class="fa-solid fa-angle-right text-primary"></i>
            <p @click="$inertia.get(route('products.create'))" class="cursor-pointer text-primary">Crear</p>
        </div>

        <div>
            
        </div>
      </div>
    </AppLayout>
  </template>
  
  <script>
    
  import AppLayout from "@/Layouts/AppLayout.vue";
  import ThirthButton from "@/Components/MyComponents/ThirthButton.vue";
  import PrimaryButton from "@/Components/PrimaryButton.vue";
  import Checkbox from "@/Components/Checkbox.vue";
  import ProductCard from "@/Components/MyComponents/ProductCard.vue";
  import { Link, useForm } from "@inertiajs/vue3";
  
  export default {

    data() {
      const form = useForm({
      color: "",
      quantity: 1,
      
    });
      return {
        form
      };
    },
    components: {
      AppLayout,
      ThirthButton,
      Checkbox,
      PrimaryButton,
      ProductCard,
      Link,
    },
    methods: {

    },
    props: {
      
    },
  };
  </script>
  
  <style></style>
  
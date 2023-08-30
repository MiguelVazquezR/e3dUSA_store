<template>
    <AppLayout>
      <div class="lg:px-8 lg:py-8">
       <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2">
        <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('products.index'))" class="cursor-pointer">Productos</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('products.show', product.id))" class="cursor-pointer text-primary">{{product.name}}</p>
      </div>

      <div class="rounded-lg lg:mx-24">
        <div class="lg:grid grid-cols-2">
  <!-- -------------------- Images ------------------ -->
          <div class="bg-[#D9D9D9] rounded-md mx-36 cursor-pointer relative">
            <figure>
              <img src="" alt="Product image">
            </figure>
            
            <figure class="w-24 h-24 bg-[#D9D9D9] absolute top-0 -left-28 cursor-pointer rounded-md border hover:border-[#9a9a9a]">
              <img src="" alt="image">
            </figure>

            <figure class="w-24 h-24 bg-[#D9D9D9] absolute top-28 -left-28 cursor-pointer rounded-md border hover:border-[#9a9a9a]">
              <img src="" alt="image">
            </figure>

            
          </div>
<!-- --------------------- Product info ------------------------ -->
          <div class="py-3 px-6">
            <h2 class="font-bold text-xl mb-1">{{ product.name }}</h2>
            <div class="flex items-center">
              <p class="text-gray-500 mr-5 text-sm">Código de parte: {{ product.part_number }}</p>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <p class="text-xs ml-3 underline cursor-pointer">Sé el primero en opinar</p>
            </div>
            <div class="relative inline-block">
              <h3 class="text-primary font-bold text-xl my-3">${{ product.price?.toString().split('.')[0] }}</h3>
              <h3 class="text-primary font-bold text-xs absolute top-3 -right-4">{{ product.price?.toString().split('.')[1] }}</h3>
            </div>
            <div class="flex space-x-7 mt-3">
              <p class="font-bold text-sm">Marca:</p>
              <p class="text-sm">{{ product.brand }}</p>
            </div>
            <div class="flex space-x-7 mt-3">
              <p class="font-bold text-sm">Modelo:</p>
              <p class="text-sm">{{ product.model }}</p>
            </div>
            <div class="flex flex-col mt-3">
              <p class="font-bold text-sm">Color:</p>
              <div class="flex space-x-2">
                <input v-model="form.color" value="black" type="radio" name="radio_group" class="bg-black border border-gray-300 rounded-full checked:bg-black checked:border-[#D90537]" />
                <input v-model="form.color" value="white" type="radio" name="radio_group" class="bg-white border border-gray-300 rounded-full checked:bg-white checked:border-[#D90537]" />
                <input v-model="form.color" value="red" type="radio" name="radio_group" class="bg-red-600 border border-gray-300 rounded-full checked:bg-red-600 checked:border-[#D90537]" />
                <input v-model="form.color" value="blue" type="radio" name="radio_group" class="bg-blue-600 border border-gray-300 rounded-full checked:bg-blue-600 checked:border-[#D90537]" />
              </div>
            </div>

            <div class="flex items-center space-x-4 my-4">
              <p class="font-bold text-sm">Cantidad:</p>
              <input v-model="form.quantity" type="number" min="1" class="input w-20 h-6 bg-[#D9D9D9] border border-transparent rounded-xl">
            </div>

            <PrimaryButton>Agregar al carrito</PrimaryButton>

            <p class="text-secondary text-xs mt-3">*El pedido debe solicitarse con al menos una semana de anticipación </p>
          </div>
        </div>
        
        <div class="mt-12 mx-48 lg:grid grid-cols-2">
          <div>
            <p class="font-bold">Acerca del producto:</p>
            <ul class="ml-3 flex flex-col">
              <li class="flex space-x-1 text-gray-600" v-for="feature in product.features?.toString().split(',')" :key="feature">- {{feature}}</li>
            </ul>
          </div>

          <div>
            <p class="font-bold">Descripción del producto:</p>
            <p class="text-gray-600">{{product.description}}</p>
          </div>
        </div>

        <div class="flex justify-center items-center space-x-2 cursor-pointer">
          <p class="text-primary">Ver más</p>
          <i class="fa-solid fa-angle-down text-white rounded-full bg-primary p-1"></i>
        </div>
      </div>

<!-- ------------------ Similar Products ----------------------- -->
      <div class="mt-24">
        <h2 class="text-lg">Artículos similares</h2>
        <div class="border-b-4 border-[#D90537] w-14"></div>

        <div class="flex mt-7 items-center justify-center">

          <div class="w-20 text-center m-3 cursor-pointer">
            <i class="fa-solid fa-chevron-left rounded-full bg-[#d9d9d9] p-4"></i>
          </div>


          <div class="w-full grid grid-cols-2 lg:grid-cols-5 gap-3 mx-4">

            <ProductCard v-for="product in similar_products" :key="product" :product="product" />
            
          </div>

          <div class="w-20 text-center m-3 cursor-pointer">
            <i class="fa-solid fa-chevron-right text-center rounded-full bg-[#d9d9d9] p-4"></i>
          </div>

        </div>
      </div>
      </div>
      <footer>
            <div class="bg-[#1a1a1a] h-auto w-full lg:grid grid-cols-3 text-center text-white relative">
                <div class="py-7 px-5">
                    <figure class="my-5">
                        <img src="@/../../public/images/logo.png" alt="Logo">
                    </figure>
                    <p class="font-bold text-white">Conocenos</p>
                    <p class="text-white hover:underline cursor-pointer">Trabajar en emblems3d</p>
                </div>

                <div class="py-7 px-5">
                    <p class="font-bold text-white mb-4">Productos</p>
                    <ul>
                        <li class="cursor-pointer hover:underline">Emblemas</li>
                        <li class="cursor-pointer hover:underline">Portaplacas</li>
                        <li class="cursor-pointer hover:underline">Llaveros</li>
                        <li class="cursor-pointer hover:underline">Tapetes de uso rudo</li>
                        <li class="cursor-pointer hover:underline">Portadocumentos</li>
                        <li class="cursor-pointer hover:underline">Perfumeros</li>
                        <li class="cursor-pointer hover:underline">Servicios de diseno</li>
                    </ul>
                </div>

                <div class="py-7 px-5 text-left">
                    <p class="font-bold text-white mb-4">Contacto</p>
                    <p class="text-white">ventas@emblemas3d.com.mx</p>

                    <p class="font-bold text-white mt-12 mb-4">Domicilio</p>
                    <figure class="flex space-x-4">
                        <img class="cursor-pointer" src="@/../../public/images/eua.png" alt="EUA">
                        <img class="cursor-pointer" src="@/../../public/images/mexico.png" alt="MX">
                    </figure>

                </div>
                <a href="https://dtw.com.mx/" target="_blank">
        <figure class="my-5 absolute bottom-1 right-4">
          <img src="@/../../public/images/logo.png" alt="Logo" />
        </figure>
        </a>
            </div>
            <p class="bg-[#1a1a1a] text-white px-3 pb-2">Copyright 2023. Emblems3dUSA todos los derechos reservados. Políticas de privacidad y administración de cookies</p>
                    
        </footer>
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
      product: Object,
      similar_products: Array,
    },
  };
  </script>
  
  <style></style>
  
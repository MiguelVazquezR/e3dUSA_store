<template>
  <AppLayout>
    <div class="lg:px-8 lg:py-8">
      <!-- ---------------------- directory ------------------------ -->
      <div class="flex justify-between items-center mx-1 mt-2">
        <div class="mb-8 flex items-center space-x-2">
          <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
          <i class="fa-solid fa-angle-right text-primary"></i>
          <p @click="$inertia.get(route('products.index'))" class="cursor-pointer text-primary">Productos</p>
        </div>
        <Link v-if="$page.props.auth.user.is_admin" :href="route('products.create')">
          <PrimaryButton>Agregar</PrimaryButton>
        </Link>
      </div>

      <div class="grid lg:grid-cols-7 gap-7">
        <div class="rounded-lg border border-[#9A9A9A] p-4">
          <div class="flex justify-between mb-2">
            <p>Filtros</p>
            <ThirthButton @click="cleanFilters" class="border-[#D90537] text-gray-700 h-6">Limpiar</ThirthButton>
          </div>
          <!-- --------------- categories filter --------------------- -->
          <p @click="categories = !categories " class="font-bold text-primary inline-flex mb-2 cursor-pointer">
            <i class="fa-solid fa-sort-down mr-1"></i>Categoría
          </p>
          <div v-if="categories" class="mx-3 space-y-1">
            <label class="flex items-center">
              <Checkbox v-model:checked="form.key_ring" />
              <span class="ml-2 text-sm text-gray-600">LLaveros</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.emblem" />
              <span class="ml-2 text-sm text-gray-600">Emblemas</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.plate_holder" />
              <span class="ml-2 text-sm text-gray-600">Portaplacas</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.textil" />
              <span class="ml-2 text-sm text-gray-600">Textiles</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.perfumers" />
              <span class="ml-2 text-sm text-gray-600">Perfumeros</span>
            </label>
          </div>
          <!-- --------------- Brand filter --------------------- -->
          <p @click="brands = !brands " class="font-bold text-primary inline-flex my-2 cursor-pointer">
            <i class="fa-solid fa-sort-down mr-1"></i>Marca
          </p>
          <div v-if="brands" class="mx-3 space-y-1">
            <label class="flex items-center">
              <Checkbox v-model:checked="form.honda" />
              <span class="ml-2 text-sm text-gray-600">Honda</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.bmw" />
              <span class="ml-2 text-sm text-gray-600">BMW</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.dalton" />
              <span class="ml-2 text-sm text-gray-600">Dalton</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.mercedez" />
              <span class="ml-2 text-sm text-gray-600">Mercedez</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.bosch" />
              <span class="ml-2 text-sm text-gray-600">Bosch</span>
            </label>
          </div>
          <!-- --------------- material filter --------------------- -->
          <p @click="materials = !materials " class="font-bold text-primary inline-flex my-2 cursor-pointer">
            <i class="fa-solid fa-sort-down mr-1"></i>Material
          </p>
          <div v-if="materials" class="mx-3 space-y-1">
            <label class="flex items-center">
              <Checkbox v-model:checked="form.aluminum" />
              <span class="ml-2 text-sm text-gray-600">Aluminio</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.abs" />
              <span class="ml-2 text-sm text-gray-600">Abs</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.metal" />
              <span class="ml-2 text-sm text-gray-600">Metal</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.resin" />
              <span class="ml-2 text-sm text-gray-600">Resina</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.textil" />
              <span class="ml-2 text-sm text-gray-600">Textil</span>
            </label>
          </div>
          <!-- --------------- color filter --------------------- -->
          <p @click="colors = !colors " class="font-bold text-primary inline-flex my-2 cursor-pointer">
            <i class="fa-solid fa-sort-down mr-1"></i>Color
          </p>
          <div v-if="colors" class="mx-3 flex space-x-2">
              <input type="checkbox" class="bg-black border border-gray-300 rounded-full checked:bg-black" v-model="form.black" />
              <input type="checkbox" class="bg-white border border-gray-300 rounded-full checked:bg-white checked:border-gray-300" v-model="form.white" />
              <input type="checkbox" class="bg-red-600 border border-gray-300 rounded-full checked:bg-red-600" v-model="form.red" />
              <input type="checkbox" class="bg-blue-600 border border-gray-300 rounded-full checked:bg-blue-600" v-model="form.blue" />
          </div>
        </div>

<!-- ----------------------- Products ---------------------------------- -->
          <div class="col-span-6 rounded-lg p-4 grid grid-cols-2 lg:grid-cols-5 gap-4">
            <ProductCard v-for="product in products" :key="product" :product="product" />
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
import ProductCard from "@/Components/MyComponents/ProductCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Link, useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      key_ring: false,
      emblem: false,
      plate_holder: false,
      textil: false,
      perfumers: false,
      honda: false,
      bmw: false,
      dalton: false,
      mercedez: false,
      bosch: false,
      aluminum: false,
      abs: false,
      metal: false,
      resin: false,
    });

    return {
      form,
      categories: true,
      brands: true,
      materials: true,
      colors: true,
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
    cleanFilters(){
      this.form.key_ring = false
      this.form.emblem = false
      this.form.plate_holder = false
      this.form.textil = false
      this.form.perfumers = false
      this.form.honda = false
      this.form.bmw = false
      this.form.dalton = false
      this.form.mercedez = false
      this.form.bosch = false
      this.form.aluminum = false
      this.form.abs = false
      this.form.metal = false
      this.form.resin = false
    }
  },
  props: {
    products: Array
  },
};
</script>


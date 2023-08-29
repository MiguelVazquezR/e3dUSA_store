<template>
  <AppLayout>
    <div class="lg:px-8 lg:py-8">
      <div class="grid lg:grid-cols-7 gap-7">
        <div class="rounded-lg border border-[#9A9A9A] p-4">
          <div class="flex justify-between mb-2">
            <p>Filtros</p>
            <ThirthButton @click="cleanFilters" class="border-[#D90537] text-gray-700 h-6">Limpiar</ThirthButton>
          </div>
          <!-- --------------- categories filter --------------------- -->
          <p @click="categories = !categories " class="font-bold text-primary flex mb-2 cursor-pointer">
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
          <p @click="brands = !brands " class="font-bold text-primary flex my-2 cursor-pointer">
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
          <p @click="materials = !materials " class="font-bold text-primary flex my-2 cursor-pointer">
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
          <p @click="colors = !colors " class="font-bold text-primary flex my-2 cursor-pointer">
            <i class="fa-solid fa-sort-down mr-1"></i>Color
          </p>
          <div v-if="colors" class="mx-3 flex space-x-2">
              <input type="checkbox" class="bg-black border border-gray-300 rounded-full checked:bg-black" v-model="form.black" />
              <input type="checkbox" class="bg-white border border-gray-300 rounded-full checked:bg-white checked:border-gray-300" v-model="form.white" />
              <input type="checkbox" class="bg-red-600 border border-gray-300 rounded-full checked:bg-red-600" v-model="form.red" />
              <input type="checkbox" class="bg-blue-600 border border-gray-300 rounded-full checked:bg-blue-600" v-model="form.blue" />
          </div>
        </div>


          <div class="col-span-6 rounded-lg border border-[#9A9A9A] p-4 grid grid-cols-2 lg:grid-cols-5 gap-4">

            <div class="border border-[#9a9a9a] rounded-lg flex flex-col justify-center text-sm lg:h-[435px]">
              <div @click="$inertia.get(route('products.show'))" class="bg-[#D9D9D9] py-2 h-1/3 rounded-lg cursor-pointer">
                <figure>
                  <img src="" alt="image">
                </figure>
              </div>
              <div class="flex flex-col mt-1 px-6 text-center">
                <h2 class="font-bold text-center">Nombre de producto</h2>
                <p>Descripcion del producto puede se un poco largo, da igual porque se tiene que pasar de renglon</p>
                <p>SKU:240N</p>
                <div class="border-b boder-[#9a9a9a] my-2"></div>
              </div>

              <h1 class="text-3xl text-secondary font-bold text-center">$89.99</h1>

              <div class="border border-[#9a9a9a] rounded-full w-20 py-1 grid grid-cols-3 px-2 mx-auto my-4">
                <span class="text-left text-secondary font-bold cursor-pointer">-</span>
                <span class="text-center">1</span>
                <span class="text-right text-secondary font-bold cursor-pointer">+</span>
              </div>

                <div class="mx-auto">
              <PrimaryButton class="px-12">Agregar</PrimaryButton>
                </div>

            </div>

          </div>

      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ThirthButton from "@/Components/MyComponents/ThirthButton.vue";
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
  props: {},
};
</script>

<style></style>

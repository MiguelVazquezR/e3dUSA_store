<template>
    <AppLayout>
      <div class="lg:px-8 lg:py-8">
        <!-- ---------------------- directory ------------------------ -->
        <div class="mb-8 flex space-x-2 items-center">
            <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
            <i class="fa-solid fa-angle-right text-primary"></i>
            <p @click="$inertia.get(route('products.index'))" class="cursor-pointer text-primary">Productos</p>
            <i class="fa-solid fa-angle-right text-primary"></i>
            <p> Crear producto</p>
        </div>

        <h2 class="text-lg font-bold ml-80 mb-5">Nuevo producto</h2>

          <div class="">
  <!-- -------------------- Images ------------------ -->
  <div class="flex space-x-5">
          <div class="bg-[#D9D9D9] rounded-md ml-36 relative lg:w-[450px] h-96">
            <figure>
              <img src="" alt="Product image">
            </figure>

            <p class="text-white text-xs rounded-full px-3 py-1 absolute top-2 right-2 bg-black">Portada del producto</p>

            <i class="fa-solid fa-camera text-lg text-primary font-bold rounded-full absolute bottom-3 right-16 bg-[#CCCCCC] py-2 px-3 cursor-pointer"></i>
            <i class="fa-solid fa-trash-can text-lg text-primary font-bold rounded-full absolute bottom-3 right-4 bg-[#CCCCCC] py-2 px-3 cursor-pointer"></i>
            
            <figure class="w-24 h-24 bg-[#D9D9D9] absolute top-0 -left-28 cursor-pointer rounded-md border hover:border-[#9a9a9a]">
              <img src="" alt="image">
            </figure>

            <figure class="w-24 h-24 bg-[#D9D9D9] absolute top-28 -left-28 cursor-pointer rounded-md border hover:border-[#9a9a9a]">
              <img src="" alt="image">
            </figure>

            <figure class="w-24 h-24 bg-[#D9D9D9] absolute top-56 -left-28 cursor-pointer rounded-md border hover:border-[#9a9a9a]">
              <img src="" alt="image">
            </figure>     

          </div>

          <div class="w-1/2 space-y-3">
          <div>
            <InputWithPlaceholder v-model="form.name">Nombre del producto *</InputWithPlaceholder>
            <InputError :message="form.errors.name" />
          </div>

            <div>
            <select v-model="form.category" class="input w-1/3" name="" id="">
              <option v-for="(category, index) in categories" :key="category" :value="category" :disabled="index == 0">{{ category }}</option>
            </select>
              <InputError :message="form.errors.category" />
            </div>

            <div>
              <InputWithPlaceholder v-model="form.part_number">Número de parte *</InputWithPlaceholder>
              <InputError :message="form.errors.part_number" />
            </div>

            <div>
              <InputWithPlaceholder v-model="form.price">Precio *</InputWithPlaceholder>
              <InputError :message="form.errors.price" />
            </div>
              
              <div>

            <label class="inline-flex cursor-pointer">
              <Checkbox v-model:checked="form.has_discount" />
              <span class="ml-2 text-xs text-gray-600 text-left">Descuento de producto</span>
            </label>
            <InputError :message="form.errors.colors" />
              </div>

              <div>
                <div class="flex items-center space-x-2">
                  <InputWithPlaceholder v-if="form.has_discount" v-model="form.discount">Descuento *</InputWithPlaceholder>
                  <input class="text-sm checked:bg-primary text-gray-600 bg-transparent" v-model="form.is_percentage" type="radio" name="es_porcentage" value="true"> % 
                  <input class="text-sm checked:bg-primary text-gray-600 bg-transparent" v-model="form.is_percentage" type="radio" name="es_porcentage" value="true"> $ 
                </div>
                <InputError :message="form.errors.discount" />
              </div>
              <div>
                <InputWithPlaceholder v-model="form.brand">Marca *</InputWithPlaceholder>
                <InputError :message="form.errors.brand" />
              </div>

              <div>
                <InputWithPlaceholder v-model="form.model">Modelo *</InputWithPlaceholder>
                <InputError :message="form.errors.model" />
              </div>
            <p class="font-bold text-black text-lg ml-4 my-2">Color:</p>
            <div class="flex items-center space-x-1">

            </div>
            <p class="cursor-pointer text-primary text-sm ml-4 my-2">+ Agregar color</p>
          </div>
  </div>

          <div class="ml-56 mb-5">
            <h2 class="text-lg font-bold mt-16">Acerca del producto</h2>
            <div class="flex space-x-7">
              <div class="w-1/3">
                <textarea v-model="form.features" class="textarea" rows="3" placeholder="Características"></textarea>
                <InputError :message="form.errors.features" />
              </div>
              <div class="w-1/3">
                <textarea v-model="form.description" class="textarea" rows="3" placeholder="descripción"></textarea>
                <InputError :message="form.errors.description" />
              </div>
            </div>
              <PrimaryButton @click="store" :disabled="form.processing" class="my-4">Crear producto</PrimaryButton>
          </div>

          <div>
          </div>
            
        </div>
      </div>
    </AppLayout>
  </template>
  
  <script>
    
  import { Link, useForm } from "@inertiajs/vue3";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import ThirthButton from "@/Components/MyComponents/ThirthButton.vue";
  import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";
  import PrimaryButton from "@/Components/PrimaryButton.vue";
  import InputError from "@/Components/InputError.vue";
  import Checkbox from "@/Components/Checkbox.vue";
  
  export default {

    data() {
      const form = useForm({
      name: null,
      category: null,
      brand: null,
      model: null,
      part_number: null,
      description: null,
      price: null,
      is_percentage: null,
      discount: null,
      discount: null,
      colors: null,
      features: [],  
      has_discount: false,
    });
      return {
        form,
        categories: [
          '----- Categoría -----',
          'Emblemas',
          'Llaveros',
          'Portaplacas',
          'Portadocumentos',
          'Perfumeros',
          'Parasoles',
        ],
      };
    },
    components: {
      AppLayout,
      ThirthButton,
      Checkbox,
      PrimaryButton,
      InputWithPlaceholder,
      InputError,
      Link,
    },
    methods: {  
      store(){
        this.form.post(route('products.store'));
        this.form.reset();
      }
    },
    props: {
      
    },
  };
  </script>
    
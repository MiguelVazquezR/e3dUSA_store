<template>
    <AppLayout title="Crear producto">
      <div class="lg:px-8 lg:py-8 pb-20">
        <!-- ---------------------- directory ------------------------ -->
        <div class="mb-8 flex space-x-2 items-center text-sm">
            <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
            <i class="fa-solid fa-angle-right text-primary"></i>
            <p @click="$inertia.get(route('products.index'))" class="cursor-pointer text-primary">Productos</p>
            <i class="fa-solid fa-angle-right text-primary"></i>
            <p> Crear producto</p>
        </div>

        <h2 class="text-lg font-bold lg:ml-80 mb-5">Nuevo producto</h2>

          <div class="">
  <!-- -------------------- Images ------------------ -->
  <div class="lg:flex space-x-5">
          <div class="bg-[#D9D9D9] rounded-md lg:ml-36 relative lg:w-[550px] lg:h-96 mx-1">
            <figure class="lg:w-[550px] lg:h-96 h-64">
              <img ref="previewImage" src="@/../../public/images/add-image.png" alt="Product image" class="lg:w-[550px] lg:h-96 h-64 object-contain bg-no-repeat opacity-60">
            </figure>

            <p class="text-white text-xs rounded-full px-3 py-1 absolute top-2 right-2 bg-black z-20">Portada del producto</p>

            <i class="fa-solid fa-camera text-lg text-primary font-bold rounded-full absolute bottom-3 right-16 bg-[#CCCCCC] py-2 px-3 cursor-pointer" @click="openFileInput('fileInput')"></i>
             <input @input="form.media = $event.target.files[0]" type="file" ref="fileInput" style="display: none" @change="handleFileChange" />

            <i class="fa-solid fa-trash-can text-lg text-primary font-bold rounded-full absolute bottom-3 right-4 bg-[#CCCCCC] py-2 px-3 cursor-pointer"></i>
            
             <div @click="openFileInput('fileInput1')" class="lg:w-36 lg:h-28 w-28 h-20 bg-[#D9D9D9] absolute -bottom-24 left-0 lg:top-0 lg:-left-40 cursor-pointer rounded-md border hover:border-[#9a9a9a]">
              <img ref="thumbnail1" src="@/../../public/images/add-image.png" alt="image" class="w-full h-full bg-cover bg-no-repeat opacity-60">
              <input @input="form.media1 = $event.target.files[0]" type="file" ref="fileInput1" style="display: none" @change="handleFileChange1" />
            </div>

            <div @click="openFileInput('fileInput2')" class="lg:w-36 lg:h-28 w-28 h-20 bg-[#D9D9D9] absolute -bottom-24 left-32 lg:top-32 lg:-left-40 cursor-pointer rounded-md border hover:border-[#9a9a9a]">
              <img ref="thumbnail2" src="@/../../public/images/add-image.png" alt="image" class="w-full h-full bg-cover bg-no-repeat opacity-60">
              <input @input="form.media2 = $event.target.files[0]" type="file" ref="fileInput2" style="display: none" @change="handleFileChange2" />
            </div>

            <div @click="openFileInput('fileInput3')" class="lg:w-36 lg:h-28 w-28 h-20 bg-[#D9D9D9] absolute -bottom-24 left-64 lg:top-64 lg:-left-40 cursor-pointer rounded-md border hover:border-[#9a9a9a]">
              <img ref="thumbnail3" src="@/../../public/images/add-image.png" alt="image" class="w-full h-full bg-cover bg-no-repeat opacity-60">
              <input @input="form.media3 = $event.target.files[0]" type="file" ref="fileInput3" style="display: none" @change="handleFileChange3" />
            </div>     

          </div>

          <div class="lg:w-1/2 space-y-3 pr-4 mt-28 lg:mt-0">
          <div>
            <InputWithPlaceholder v-model="form.name">Nombre del producto *</InputWithPlaceholder>
            <InputError :message="form.errors.name" />
          </div>

            <div>
            <select v-model="form.category" class="input lg:w-1/3 h-11" name="" id="">
              <option v-for="(category, index) in categories" :key="category" :value="category" :disabled="index == 0">{{ category }}</option>
            </select>
              <InputError :message="form.errors.category" />
            </div>

            <div>
            <select v-model="form.material" class="input lg:w-1/3 h-11" name="" id="">
              <option v-for="(material, index) in materials" :key="material" :value="material" :disabled="index == 0">{{ material }}</option>
            </select>
              <InputError :message="form.errors.material" />
            </div>

            <div>
              <InputWithPlaceholder v-model="form.part_number">Número de parte *</InputWithPlaceholder>
              <InputError :message="form.errors.part_number" />
            </div>

            <div>
              <InputWithPlaceholder :inputType="number" v-model="form.stock">Cantidad en stock *</InputWithPlaceholder>
              <InputError :message="form.errors.stock" />
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
                <div v-if="form.has_discount" class="flex items-center space-x-2">
                  <InputWithPlaceholder v-model="form.discount">Descuento *</InputWithPlaceholder>
                  <input class="text-sm checked:bg-primary text-gray-600 bg-transparent mr-1" v-model="form.is_percentage" type="radio" name="es_porcentage" :value="true"> % 
                  <input class="text-sm checked:bg-primary text-gray-600 bg-transparent mr-1" v-model="form.is_percentage" type="radio" name="es_porcentage" :value="false"> $ 
                <InputError :message="form.errors.is_percentage" />
                </div>
                <InputError :message="form.errors.discount" />
              </div>
              <div>
                <InputWithPlaceholder v-model="form.brand">Marca *</InputWithPlaceholder>
                <InputError :message="form.errors.brand" />
              </div>

              <div>
                <InputWithPlaceholder v-model="form.model">Modelo</InputWithPlaceholder>
                <InputError :message="form.errors.model" />
              </div>
            <p class="font-bold text-black text-lg ml-4 my-2">Color:</p>
            <div class="flex items-center space-x-1">

            </div>
            <p class="cursor-pointer text-primary text-sm ml-4 my-2">+ Agregar color</p>
          </div>
  </div>

          <div class="lg:ml-56 lg:mb-5 mx-3">
            <h2 class="text-lg font-bold mt-16 mb-4">Acerca del producto</h2>
            <div class="flex space-x-7">
              <div class="lg:w-1/3">
                <textarea v-model="form.features" class="textarea" rows="3" placeholder="Características"></textarea>
                <InputError :message="form.errors.features" />
              </div>
              <div class="lg:w-1/3">
                <textarea v-model="form.description" class="textarea" rows="3" placeholder="Descripción"></textarea>
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
      category: '----- Categoría -----',
      material: '----- Material -----',
      brand: null,
      model: null,
      part_number: null,
      description: null,
      price: null,
      is_percentage: null,
      stock: null,
      discount: null,
      colors: null,
      features: null,  
      has_discount: false,
      media: [],
      media1: [],
      media2: [],
      media3: [],
    });
      return {
        form,
        categories: [
          '----- Categoría -----',
          'Emblemas',
          'Llaveros',
          'Tapetes',
          'Portaplacas',
          'Portadocumentos',
          'Perfumeros',
          'Parasoles',
        ],
        materials: [
          '----- Material -----',
          'Aluminio',
          'Abs',
          'Metal',
          'Resina',
          'Caucho',
          'Textil',
          'Otro',
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
        if(this.form.has_discount == false){
          this.form.discount = null;
          this.form.is_percentage = null;
        }
        this.form.post(route('products.store'), {
          onSuccess: () => {
            this.$notify({
              title: 'Correcto',
              message: 'Se ha registrado el producto',
              type: 'success',
            });
          },
        });
        this.form.reset();
      },
      openFileInput(ref) {
      // Simula un clic en el input de tipo file cuando se hace clic en el icono de la cámara
      this.$refs[ref].click();
    },
    handleFileChange(event) {
      const image = event.target.files[0];
      // Comprueba si se seleccionó un archivo y es una imagen
      if (image && image.type.startsWith('image/')) {
        const reader = new FileReader();


        reader.onload = () => {
          // Asigna la vista previa de la imagen al elemento img con ref="previewImage"
          this.$refs.previewImage.src = reader.result;
        };

        // Lee el archivo como una URL de datos
        reader.readAsDataURL(image);
      }
    },

    handleFileChange1(event) {
       const image1 = event.target.files[0];
       console.log(image1);
      // Comprueba si se seleccionó un archivo y es una imagen
      if (image1 && image1.type.startsWith('image/')) {
        const reader = new FileReader();


        reader.onload = () => {
          // Asigna la vista previa de la imagen al elemento img con ref="thumbnail1"
          this.$refs.thumbnail1.src = reader.result;
        };

        // Lee el archivo como una URL de datos
        reader.readAsDataURL(image1);
      }
    },

    handleFileChange2(event) {
       const image2 = event.target.files[0];
      // Comprueba si se seleccionó un archivo y es una imagen
      if (image2 && image2.type.startsWith('image/')) {
        const reader = new FileReader();


        reader.onload = () => {
          // Asigna la vista previa de la imagen al elemento img con ref="thumbnail2"
          this.$refs.thumbnail2.src = reader.result;
        };

        // Lee el archivo como una URL de datos
        reader.readAsDataURL(image2);
      }
    },

    handleFileChange3(event) {
       const image3 = event.target.files[0];
      // Comprueba si se seleccionó un archivo y es una imagen
      if (image3 && image3.type.startsWith('image/')) {
        const reader = new FileReader();


        reader.onload = () => {
          // Asigna la vista previa de la imagen al elemento img con ref="thumbnail3"
          this.$refs.thumbnail3.src = reader.result;
        };

        // Lee el archivo como una URL de datos
        reader.readAsDataURL(image3);
      }
    },
    },
    props: {
      
    },
  };
  </script>
    
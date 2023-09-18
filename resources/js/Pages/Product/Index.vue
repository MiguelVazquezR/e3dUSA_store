<template>
  <AppLayout>
    <div class="lg:px-8 lg:py-8 pb-12 py-5">
      <!-- ---------------------- directory ------------------------ -->
      <div class="flex justify-between items-center mx-1 mt-2 text-sm">
        <div class="mb-8 flex items-center space-x-2">
          <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
          <i class="fa-solid fa-angle-right text-primary"></i>
          <p class="">Productos</p>
        </div>
        <Link v-if="$page.props.auth.user.is_admin" :href="route('products.create')">
          <PrimaryButton>Agregar</PrimaryButton>
        </Link>
      </div>

      <div class="lg:hidden border border-[#9A9A9A] py-1 px-2 flex justify-between mx-4 rounded-md mb-1 mt-4">
        <p @click="orderModal = true" class="text-primary border-r border-[#9A9A9A] text-center w-1/2"><i class="fa-solid fa-sort mr-3"></i>Ordenar</p>
        <p @click="filterModal = true" class="text-primary text-center w-1/2"><i class="fa-solid fa-arrow-up-short-wide mr-3"></i>Filtros</p>
      </div>

      <div class="hidden lg:grid lg:grid-cols-7 gap-7 mt-5">
        <div class="flex flex-col rounded-lg border border-[#9A9A9A] p-4">
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
              <Checkbox v-model:checked="form.mats" />
              <span class="ml-2 text-sm text-gray-600">Tapetes</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.perfumers" />
              <span class="ml-2 text-sm text-gray-600">Perfumeros</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.parasols" />
              <span class="ml-2 text-sm text-gray-600">Parasoles</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.discounts" />
              <span class="ml-2 text-sm text-gray-600">Descuentos</span>
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
              <Checkbox v-model:checked="form.rubber" />
              <span class="ml-2 text-sm text-gray-600">Caucho</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.textile" />
              <span class="ml-2 text-sm text-gray-600">Textil</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.other" />
              <span class="ml-2 text-sm text-gray-600">Otro</span>
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
          <div class="text-center mt-7">
            <PrimaryButton @click="filter">Aplicar</PrimaryButton>
          </div>
        </div>

<!-- ----------------------- Products large screen ---------------------------------- -->
          <div v-if="products.data.length" @scroll="chargeMoreProducts" class="col-span-6 rounded-lg p-4 grid lg:grid-cols-5 gap-4 ">
            <ProductCard v-for="product in products.data" :key="product" :product="product" />
          </div>

          <div class="flex justify-center col-span-6" v-else>
            <p class="text-sm text-center text-gray-500">No hay productos para mostrar</p>
          </div>

      </div>

<!-- --------------- Products resposive view ------------------------ -->
      <div v-if="products.data.length" @scroll="chargeMoreProducts" class="lg:hidden col-span-6 rounded-lg p-4 grid grid-cols-2 gap-2 mt-3">
            <ProductCard v-for="product in products.data" :key="product" :product="product" />
          </div>
          <div v-else>
            <p class="text-sm text-center text-gray-500 my-5">No hay productos para mostrar en la sección se productos relacionados</p>
          </div>
    </div>

    <Modal :show="orderModal || filterModal " @close="orderModal = false; filterModal = false">
        <form @submit.prevent="storeInvoice" class="mx-7 my-4 space-y-4 relative px-3">
            <div @click="orderModal = false; filterModal = false"
                class="cursor-pointer w-5 h-5 rounded-full border-2 border-black flex items-center justify-center absolute top-0 right-0">
                <i class="fa-solid fa-xmark"></i>
              </div>

                <!-- ------------------------- fiilter section -------------------------- -->
                <div v-if="filterModal" class="p-3">
                  <div class="flex justify-between my-3">
                    <p>filtros</p>
                    <ThirthButton @click="cleanFilters" class="border-[#D90537] text-gray-700 h-6">Limpiar</ThirthButton>
                  </div>

                  <!-- --------------- categories filter --------------------- -->
          <div class="flex flex-col">
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
              <Checkbox v-model:checked="form.mats" />
              <span class="ml-2 text-sm text-gray-600">Tapetes</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.perfumers" />
              <span class="ml-2 text-sm text-gray-600">Perfumeros</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.parasols" />
              <span class="ml-2 text-sm text-gray-600">Parasoles</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.discounts" />
              <span class="ml-2 text-sm text-gray-600">Descuentos</span>
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
              <Checkbox v-model:checked="form.rubber" />
              <span class="ml-2 text-sm text-gray-600">Caucho</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.textile" />
              <span class="ml-2 text-sm text-gray-600">Textil</span>
            </label>
            <label class="flex items-center">
              <Checkbox v-model:checked="form.other" />
              <span class="ml-2 text-sm text-gray-600">Otro</span>
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
                </div>

<!-- ------------------ Order section ----------------- -->
          <div v-if="orderModal" class="p-3">
            <div class="flex justify-between my-3">
                    <p>Ordenar por</p>
                    <ThirthButton @click="cleanFilters" class="border-[#D90537] text-gray-700 h-6">Limpiar</ThirthButton>
                  </div>
            <div class="">
              <div class="text-[#9a9a9a] space-y-2">
                  <p>Más buscados
                    <input class="bg-transparent text-primary focus:ring-0 ml-9" type="radio" name="orderBy" >
                  </p>
                  <p>Más vendidos
                    <input class="bg-transparent text-primary focus:ring-0 ml-9" type="radio" name="orderBy" >
                  </p>
                  <p>Nombre de la A a la Z
                    <input class="bg-transparent text-primary focus:ring-0 ml-9" type="radio" name="orderBy" >
                  </p>
                  <p>Nombre de la Z a la A
                    <input class="bg-transparent text-primary focus:ring-0 ml-9" type="radio" name="orderBy" >
                  </p>
                  <p>Precio mayor a menor
                    <input class="bg-transparent text-primary focus:ring-0 ml-9" type="radio" name="orderBy" >
                  </p>
                  <p>Precio menor mayor
                    <input class="bg-transparent text-primary focus:ring-0 ml-9" type="radio" name="orderBy" >
                  </p>
              </div>
            </div>
          </div>
          

          <!-- -------- Buttons ----- -->
          <div class="flex justify-end space-x-3 pt-5 pb-1">
            <CancelButton @click="orderModal = false; filterModal = false">Cancelar</CancelButton>
            <PrimaryButton @click="filter" :disabled="form.processing">Aplicar</PrimaryButton>
          </div>
        </form>
      </Modal>

  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ThirthButton from "@/Components/MyComponents/ThirthButton.vue";
import ProductCard from "@/Components/MyComponents/ProductCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import Checkbox from "@/Components/Checkbox.vue";
import { Link, useForm } from "@inertiajs/vue3";
import axios from 'axios';

export default {
  data() {
    const form = useForm({
      key_ring: false,
      emblem: false,
      plate_holder: false,
      mats: false,
      perfumers: false,
      parasols: false,
      discounts: false,
      honda: false,
      bmw: false,
      dalton: false,
      mercedez: false,
      bosch: false,
      aluminum: false,
      abs: false,
      metal: false,
      resin: false,
      rubber: false,
      textile: false,
      other: false,
    });

    return {
      form,
      orderModal: false,
      filterModal: false,
      categories: true,
      brands: true,
      materials: true,
      colors: true,
      currentPage: 1,
      isLoading: false,
      hasMorePages: true,
    };
  },
  components: {
    AppLayout,
    ThirthButton,
    Checkbox,
    PrimaryButton,
    ProductCard,
    Modal,
    CancelButton,
    Link,
  },
  methods: {
    cleanFilters(){
      this.form.reset();
    },
    async filter(){
      try {
        const response = await axios.post(route('products.filter'), {
          key_ring: this.form.key_ring ,
          emblem: this.form.emblem,
          plate_holder: this.form.plate_holder,
          mats: this.form.mats,
          perfumers: this.form.perfumers,
          parasols: this.form.parasols,
          discounts: this.form.discounts,
          honda: this.form.honda,
          bmw: this.form.bmw,
          dalton: this.form.dalton,
          mercedez: this.form.mercedez,
          bosch: this.form.bosch,
          aluminum: this.form.aluminum,
          abs: this.form.abs,
          metal: this.form.metal,
          resin: this.form.resin,
          rubber: this.form.rubber,
          textile: this.form.textile,
          other: this.form.other,
        });
        if(response.status === 200){
          console.log(response.data)
          this.products.data = response.data.items;
        }
      } catch (error) {
        console.log(error);
      } finally {
        this.filterModal = false;
      }
    },
    //  chargeMoreProducts() {
    //     if (!this.isLoading && this.hasMorePages) {
    //         this.isLoading = true;
    //         axios.get(`/products?page=${this.currentPage + 1}`)
    //             .then(response => {
    //                 this.products.data = this.products.data.concat(response.data.data);
    //                 this.currentPage = response.data.current_page;
    //                 this.isLoading = false;
    //                 this.hasMorePages = response.data.next_page_url !== null;
    //             })
    //             .catch(error => {
    //                 console.error(error);
    //                 this.isLoading = false;
    //             });
    //     }
    // },
  },
  props: {
    products: Object
  },
};
</script>


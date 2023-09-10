<template>
    <AppLayout>
      <div class="lg:px-8 lg:py-16 pb-20 pt-5">
      <!-- ---------------------- directory ------------------------ -->
      <div class="flex justify-between items-center mx-1 mt-2 text-sm">
        <div class="mb-8 flex items-center space-x-2">
          <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('products.index'))" class="cursor-pointer">Productos</p>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p @click="$inertia.get(route('products.show', product.id))" class="cursor-pointer text-primary">{{product.name}}</p>
        </div>
        <Link v-if="$page.props.auth.user.is_admin" :href="route('products.edit', product.id)">
          <PrimaryButton><i @click="$inertia.get(route('products.edit', product.id))" class="fa-solid fa-pen text-sm text-white mr-2"></i>Editar</PrimaryButton>
        </Link>
      </div>

      <div class="rounded-lg lg:mx-24 mt-4">
        <div class="lg:grid grid-cols-2">
  <!-- -------------------- Images ------------------ -->
          <div class="bg-[#D9D9D9] rounded-md mx-36 relative hidden lg:block">
            <figure class="">
              <img :src="product.media[0]?.original_url" alt="Product image" class="lg:w-[550px] lg:h-96 h-64 object-contain bg-no-repeat"
              @mouseover="showZoom"
              @mousemove="updateZoomPosition"
              @mouseout="hideZoom">
            </figure>
              <div class="border border-gray-600 h-36 w-36 -bottom-0 right-0 rounded-lg bg-cover absolute" ref="zoomBox" v-if="isZoomVisible" :style="zoomBoxStyle"></div>
            
            <figure class="lg:w-36 lg:h-28 w-28 h-20 bg-[#D9D9D9] absolute  -bottom-24 left-0 lg:top-0 lg:-left-40 cursor-pointer rounded-lg border hover:border-[#9a9a9a]">
              <img :src="product.media[1]?.original_url" alt="image" class="w-full h-full bg-cover bg-no-repeat">
            </figure>

            <figure class="lg:w-36 lg:h-28 w-28 h-20 bg-[#D9D9D9] absolute -bottom-24 left-32 lg:top-32 lg:-left-40 cursor-pointer rounded-lg border hover:border-[#9a9a9a]">
              <img :src="product.media[2]?.original_url" alt="image" class="w-full h-full bg-cover bg-no-repeat">
            </figure>

            <figure class="lg:w-36 lg:h-28 w-28 h-20 bg-[#D9D9D9] absolute -bottom-24 left-64 lg:top-64 lg:-left-40 cursor-pointer rounded-lg border hover:border-[#9a9a9a]">
              <img :src="product.media[3]?.original_url" alt="image" class="w-full h-full bg-cover bg-no-repeat">
            </figure>

            
          </div>
<!-- --------------------- Product info ------------------------ -->
          <div class="py-3 px-6">
            <h2 class="font-bold text-xl mb-1">{{ product.name }}</h2>
            <div class="flex items-center">
              <p class="text-gray-500 mr-5 text-xs lg:text-sm">Código de parte: {{ product.part_number }}</p>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <i class="fa-regular fa-star text-sm text-yellow-400"></i>
              <p class="text-xs ml-3 underline cursor-pointer">Sé el primero en opinar</p>
            </div>


<!-- ------------- responsive images ---------------------- -->
            <div class="lg:hidden mb-40 mt-3 relative">
              <figure class="bg-[#D9D9D9] rounded-lg">
              <img :src="product.media[0]?.original_url" class="object-contain bg-no-repeat w-96 h-56" alt="Product image">
            </figure>
            <figure class="lg:w-36 lg:h-28 w-28 h-20 bg-[#D9D9D9] absolute  -bottom-24 left-0 lg:top-0 lg:-left-40 cursor-pointer rounded-lg border hover:border-[#9a9a9a]">
              <img :src="product.media[1]?.original_url" alt="image" class="w-full h-full object-contain bg-no-repeat">
            </figure>

            <figure class="lg:w-36 lg:h-28 w-28 h-20 bg-[#D9D9D9] absolute -bottom-24 left-28 lg:top-32 lg:-left-40 cursor-pointer rounded-lg border hover:border-[#9a9a9a]">
              <img :src="product.media[2]?.original_url" alt="image" class="w-full h-full object-contain bg-no-repeat">
            </figure>

            <figure class="lg:w-36 lg:h-28 w-28 h-20 bg-[#D9D9D9] absolute -bottom-24 left-56 lg:top-64 lg:-left-40 cursor-pointer rounded-lg border hover:border-[#9a9a9a]">
              <img :src="product.media[3]?.original_url" alt="image" class="w-full h-full object-contain bg-no-repeat">
            </figure>
            </div>

<!-- ------------- if product has discount. Original price ------------- -->
            <div v-if="product.discount" class="relative -mb-6">
              <h3 class="text-sm my-3 line-through">${{ (product.price * form.quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</h3>
            </div>
 <!-- ------------- Final price with or without discount -------------->
            <div class="relative inline-block">
              <h3 class="text-primary font-bold text-xl my-3">${{product?.is_percentage ? ((product?.price * (100 - product?.discount) * 0.01) * form.quantity).toString().split('.')[0]
            : ((product?.price - product?.discount) * form.quantity).toString().split('.')[0]
              }}
             </h3>
              <h3 class="text-primary font-bold text-xs absolute top-3 -right-4">{{(( product.price * form.quantity).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")).toString().split('.')[1] ?? '00' }}</h3>
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
              <input v-model="form.quantity" type="number" min="1" :max="product.stock" class="input w-20 h-6 bg-[#D9D9D9] border border-transparent rounded-xl">
              <p class="text-xs text-gray-500">{{ product.stock }} disponibles </p>
            </div>

            <div class="text-center">
              <PrimaryButton @click="addToCart">Agregar al carrito</PrimaryButton>
            </div>

            <p class="text-secondary text-xs mt-3">*El pedido debe solicitarse con al menos una semana de anticipación </p>
          </div>
        </div>
        
        <div class="mt-12 lg:mx-48 lg:grid grid-cols-2 mx-3">
          <div>
            <p class="font-bold">Acerca del producto:</p>
            <ul class="ml-3 flex flex-col">
              <li class="flex space-x-1 text-gray-600" v-for="feature in product.features?.toString().split(',')" :key="feature">- {{feature}}</li>
            </ul>
          </div>

          <div class="mt-8 lg:mt-0">
            <p class="font-bold">Descripción del producto:</p>
            <p class="text-gray-600">{{product.description}}</p>
          </div>
        </div>

        <div class="flex justify-center items-center space-x-2 cursor-pointer mt-5">
          <p class="text-primary">Ver más</p>
          <i class="fa-solid fa-angle-down text-white rounded-full bg-primary p-1"></i>
        </div>
      </div>

<!-- ------------------ Similar Products ----------------------- -->
      <div class="mt-24 mx-4">
        <h2 class="lg:text-lg">Artículos similares</h2>
        <div class="border-b-4 border-[#D90537] w-14"></div>

        <div class="flex mt-7 items-center justify-center">

          <div class="w-20 text-center m-3 cursor-pointer">
            <i class="fa-solid fa-chevron-left rounded-full bg-[#d9d9d9] p-4"></i>
          </div>


          <div class="w-full lg:grid grid-cols-5 gap-3 mx-4">

            <ProductCard v-for="product in similar_products" :key="product" :product="product" />
            
          </div>

          <div class="w-20 text-center m-3 cursor-pointer">
            <i class="fa-solid fa-chevron-right text-center rounded-full bg-[#d9d9d9] p-4"></i>
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
  import ProductCard from "@/Components/MyComponents/ProductCard.vue";
  import { Link, useForm } from "@inertiajs/vue3";
  
  export default {

    data() {
      const form = useForm({
      color: "",
      quantity: 1,
      
    });
      return {
        form,
        isZoomVisible: false,
        zoomBoxStyle: {
        left: "100%", // Ajusta la posición inicial
        top: "0", // Ajusta la posición inicial
        backgroundImage: "url('ruta_de_tu_imagen.jpg')", // Usa la misma imagen
        backgroundSize: "300px", // Ajusta el tamaño según tus necesidades
      },
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
      showZoom() {
      this.isZoomVisible = true;
    },
    hideZoom() {
      this.isZoomVisible = false;
    },
     updateZoomPosition(event) {
      // Obtiene la posición relativa del cursor en la imagen
      const image = event.target;
      const zoomBox = this.$refs.zoomBox;

      const imageRect = image.getBoundingClientRect();
      const x = event.clientX - imageRect.left;
      const y = event.clientY - imageRect.top;

      // Ajusta la posición del cuadro de zoom
      this.zoomBoxStyle.left = x - zoomBox.clientWidth / 2 + "px";
      this.zoomBoxStyle.top = y - zoomBox.clientHeight / 2 + "px";
    },
    addToCart(){
      this.$inertia.post(route('cart-products.store', {'product': this.product, 'quantity': this.form.quantity }));
    }
    },
    props: {
      product: Object,
      similar_products: Array,
    },
  };
  </script>
  
  
<template>
    <AppLayout title="Dashboard">
        <div class="pb-12 pt-4 px-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <figure>
                    <img class="w-full" src="@/../../public/images/banner.png" alt="banner">
                </figure>

<!-- --------------------- todas las categorias start ----------------------------- -->
                <div class="mt-7">
                    <h2 class="text-xl text-left ">Todas las categorias</h2>

                    <div class="mt-5 grid grid-cols-3 gap-1 lg:grid-cols-6 lg:gap-4 transition ease-linear duration-300 justify-center text-center">
                        <div @click="$inertia.get(route('products.index'))" v-for="categoryCard in categories1" :key="categoryCard" class="cursor-pointer h-36 hover:border-[#D90537] hover:scale-105 mt-3 lg:mt-0 rounded-lg border-2 border-[#D90537] px-2 py-4 flex flex-col space-y-3 justify-center text-center">
                            <figure class="h-2/3 mx-auto flex items-center">
                                <img :src="categoryCard.image" :alt="categoryCard.alt">
                            </figure>
                            <div class="h-1/3">
                            <p class="text-primary">{{ categoryCard.name }}</p>
                            </div>
                        </div>

                        <div @click="all_categories = !all_categories" class="mt-3 lg:mt-0 cursor-pointer rounded-lg border-2 border-[#D90537] bg-primary px-2 py-4 flex flex-col space-y-3 justify-center text-center text-white">
                            <p class="font-bold">Descubre todas las categorias</p>
                            <i v-if="all_categories" class="fa-solid fa-chevron-up"></i>
                            <i v-else class="fa-solid fa-chevron-down"></i>
                        </div>

                        <div v-if="all_categories" @click="$inertia.get(route('products.index'))"  v-for="categoryCard in categories2" :key="categoryCard" class="cursor-pointer h-36 hover:border-[#D90537] hover:scale-105 mt-3 lg:mt-0 rounded-lg border-2 border-[#D90537] px-2 py-4 flex flex-col space-y-3 justify-center text-center">
                            <figure class="h-2/3 mx-auto flex items-center">
                                <img :src="categoryCard.image" :alt="categoryCard.alt">
                            </figure>
                            <div class="h-1/3">
                            <p class="text-primary">{{ categoryCard.name }}</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
<!-- --------------------- todas las categorias end ----------------------------- -->


<!-- --------------------- Beneficios de comprar en emblems3d start ----------------------------- -->
                <div class="mt-7">
                    <h2 class="text-xl text-left ">Beneficios de comprar en emblems3d</h2>

                    <div class="mt-5 grid grid-cols-2 lg:grid-cols-4 gap-4 transition ease-linear duration-300">
                        <div @click="safeShippingModal = true" class="py-2 px-4 mb-9 flex space-x-3 justify-center text-center relative cursor-pointer mt-10 lg:mt-0">
                            <figure>
                                <img src="@/../../public/images/Vector.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Envio seguro</p>
                            <div class="border-b-2 border-[#0355B5] w-36 lg:w-56 absolute -bottom-2"></div>
                            <div class="border-b-2 border-[#0355B5] w-36 lg:w-56 absolute -bottom-4 left-0"></div>
                        </div>

                        <div @click="onTimeModal = true" class="py-2 px-4 mb-9 flex space-x-3 justify-center text-center relative cursor-pointer mt-10 lg:mt-0">
                            <figure>
                                <img src="@/../../public/images/Vector-1.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Entregas a tiempo</p>
                            <div class="border-b-2 border-[#0355B5] w-36 lg:w-56 absolute -bottom-2"></div>
                            <div class="border-b-2 border-[#0355B5] w-36 lg:w-56 absolute -bottom-4 left-0"></div>
                        </div>

                        <div @click="innovationModal = true" class="py-2 px-4 mb-9 flex space-x-3 justify-center text-center relative cursor-pointer mt-10 lg:mt-0">
                            <figure>
                                <img src="@/../../public/images/Vector-2.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Innovacion y tendencia</p>
                            <div class="border-b-2 border-[#0355B5] w-36 lg:w-56 absolute -bottom-2"></div>
                            <div class="border-b-2 border-[#0355B5] w-36 lg:w-56 absolute -bottom-4 left-0"></div>
                        </div>

                        <div @click="qualityModal = true" class="py-2 px-4 mb-9 flex space-x-3 justify-center text-center relative cursor-pointer mt-10 lg:mt-0">
                            <figure>
                                <img src="@/../../public/images/Vector-3.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Calidad de primera</p>
                            <div class="border-b-2 border-[#0355B5] w-36 lg:w-56 absolute -bottom-2"></div>
                            <div class="border-b-2 border-[#0355B5] w-36 lg:w-56 absolute -bottom-4 left-0"></div>
                        </div>
                        
                    </div>
                </div>
<!-- --------------------- Beneficios de comprar en emblems3d end ----------------------------- -->


<!-- --------------------- Marcas principales start ----------------------------- -->
                <div class="mt-7">
                    <h2 class="text-xl text-left ">Marcas principales</h2>

                    <div class="mt-5 grid grid-cols-4 gap-1 lg:grid-cols-5 lg:gap-4 transition ease-linear duration-300">
                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img class="grayscale hover:grayscale-0" src="@/../../public/images/honda.png" alt="Honda">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img class="grayscale hover:grayscale-0" src="@/../../public/images/kia-color-logo.png" alt="Kia">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img class="grayscale hover:grayscale-0" src="@/../../public/images/mercedes-color-logo.png" alt="Mercedez">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img class="grayscale hover:grayscale-0" src="@/../../public/images/mini-color-logo.png" alt="Mini">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img class="grayscale hover:grayscale-0" src="@/../../public/images/volvo-color-logo.png" alt="volvo">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img class="grayscale hover:grayscale-0" src="@/../../public/images/bmw-color-logo.png" alt="BMW">
                            </figure>
                        </div>

                    </div>
                </div>
<!-- --------------------- Marcas principales end ----------------------------- -->


<!-- --------------------- Productos recomendados start ----------------------------- -->
                <div class="mt-7">
                    <h2 class="text-xl text-left ">Productos recomendados <span class="text-primary hover:underline ml-3 cursor-pointer underline">Ver más</span></h2>

                    <div v-if="discount_products.length" class="mt-5 grid grid-cols-2 gap-2 lg:grid-cols-5 lg:gap-4 transition ease-linear duration-300">
                        <DiscountProduct v-for="discount_product in discount_products" :key="discount_product" :discount_product="discount_product" />
                    </div>
                    <div v-else>
                        <p class="text-sm text-ceter my-9 text-gray-500">No hay productos para mostrar</p>
                    </div>
                </div>
<!-- --------------------- Productos recomendados end ----------------------------- -->


<!-- --------------------- Recibe nuestras notificaciones start ----------------------------- -->
                <div class="my-7">
                    <h2 class="text-lg mb-5">Recibe nuestras notificaciones</h2>
                    <div class="flex items-center">
                        <input v-model="form.email" type="text" class="input w-1/2 mr-4" placeholder="Ingresa tu email">
                        <InputError :message="form.errors.email" />
                        <PrimaryButton @click.prevent="storeNotificationEmail()">Suscribirse</PrimaryButton>
                    </div>
                </div>
            </div>
        </div>


        <!-- -------------- Modal starts----------------------- -->
        <DialogModal :show="safeShippingModal || onTimeModal || innovationModal || qualityModal" 
        @close="safeShippingModal = false; onTimeModal = false; innovationModal = false; qualityModal = false">
                <template #title>
                    <div class="relative border-b-2 border-[#0355B5] w-1/2 mx-auto">
                        <p class="text-secondary text-3xl text-center font-bold" v-if="safeShippingModal">Envio seguro</p>
                        <p class="text-secondary text-3xl text-center font-bold" v-else-if="onTimeModal">Entregas a tiempo</p>
                        <p class="text-secondary text-3xl text-center font-bold" v-else-if="innovationModal">Innovacion y tendencia</p>
                        <p class="text-secondary text-3xl text-center font-bold" v-else-if="qualityModal">Calidad de primera</p>
                        <div class="border-b-2 border-[#0355B5] w-40 lg:w-72 absolute -bottom-3 -left-7"></div>
                    </div>
                </template>
                <template #content>
                    <p class="mt-5" v-if="safeShippingModal">Tu tranquilidad es nuestra prioridad. Te garantizamos que tus productos llegarán a tus manos en perfectas condiciones. </p>
                    <p class="mt-5" v-else-if="onTimeModal">El tiempo de nuestros clientes es nuestro tiempo, respetando los lapsos de entrega con compromiso e incluso reduciéndolos.</p>
                    <p class="mt-5" v-else-if="innovationModal">Somos referentes para otras empresas por estar en vanguardia, nos actualizamos con la tecnología porque sabemos que los tiempos y las necesidades cambian constantemente.</p>
                    <p class="mt-5" v-else-if="qualityModal">Nuestros productos se caracterizan por su alta durabilidad, su resistencia a extremas temperaturas y su portabilidad que le da lujo y representan tu marca.</p>
                </template>
                <template #footer>
                    <CancelButton @click="safeShippingModal = false; onTimeModal = false; innovationModal = false; qualityModal = false">
                        Cerrar</CancelButton>
                </template>
            </DialogModal>
            <!-- --------------------------- Modal ends ------------------------------------ -->
            
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";
import DiscountProduct from "@/Components/MyComponents/DiscountProduct.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import DialogModal from "@/Components/DialogModal.vue";

import portaplacas from '@/../../public/images/portaplacas.png';
import Llaveros from '@/../../public/images/llaveros.png';
import Emblemas from '@/../../public/images/logonegro.png';
import Tapetes from '@/../../public/images/tapete.png';
import Portadocumentos from '@/../../public/images/portadocumentos.png';

export default {
  data() {

    const form = useForm({
      email: null,
    });

    return {
        form,
        all_categories: false,
        safeShippingModal: false,
        onTimeModal: false,
        innovationModal: false,
        qualityModal: false,
        categories1: [
            {
                name: 'Porta placas',
                image: portaplacas,
                alt: 'Portaplacas'
            },
            {
                name: 'Llaveros',
                image: Llaveros,
                alt: 'Llaveros'
            },
            {
                name: 'Emblemas',
                image: Emblemas,
                alt: 'Emblemas'
            },
            {
                name: 'Tapetes de uso rudo',
                image: Tapetes,
                alt: 'Tapetes'
            },
            {
                name: 'Porta documentos',
                image: Portadocumentos,
                alt: 'Portadocumentos'
            },
        ],
        categories2: [
            {
                name: 'Perfumeros',
                image: '@/../../public/images/portaplacas.png',
                alt: 'Perfumeros'
            },
            {
                name: 'Paraguas',
                image: '@/../../public/images/llaveros.png',
                alt: 'Paraguas'
            },
            {
                name: 'Fundas',
                image: '@/../../public/images/logonegro.png',
                alt: 'Fundas'
            },
            {
                name: 'Parasol',
                image: '@/../../public/images/tapete.png',
                alt: 'Parasol'
            },
            {
                name: 'Prenda',
                image: '@/../../public/images/portadocumentos.png',
                alt: 'Prenda'
            },
            {
                name: 'Botella',
                image: '@/../../public/images/portadocumentos.png',
                alt: 'Botella'
            },
        ],
    };
  },
  props: {
    discount_products: Array
  },
  components: {
    AppLayout,
    PrimaryButton,
    Link,
    DialogModal,
    CancelButton,
    DiscountProduct,
    InputError,
    InputWithPlaceholder
  },
  methods:{
    storeNotificationEmail(){
        this.form.post(route('notification-emails.store'));
        this.form.reset();
    },
  },

};
</script>

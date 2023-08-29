<template>
    <AppLayout title="Dashboard">
        <div class="py-8 px-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <figure>
                    <img src="@/../../public/images/banner.png" alt="banner">
                </figure>

<!-- --------------------- todas las categorias start ----------------------------- -->
                <div class="mt-7">
                    <h2 class="text-xl text-left ">Todas las categorias</h2>

                    <div class="mt-5 md:grid grid-cols-6 gap-4 transition ease-linear duration-300">
                        <div @click="$inertia.get(route('products.index'))" v-for="categoryCard in categories1" :key="categoryCard" class="cursor-pointer hover:border-[#D90537] hover:scale-105 mt-3 lg:mt-0 rounded-lg border-2 border-[#D90537] px-2 py-8 flex flex-col space-y-3 justify-center text-center">
                            <figure>
                                <img :src="categoryCard.image" :alt="categoryCard.alt">
                            </figure>
                            <p class="text-primary">{{ categoryCard.name }}</p>
                        </div>

                        <div @click="all_categories = !all_categories" class="mt-3 lg:mt-0 cursor-pointer rounded-lg border-2 border-[#D90537] bg-primary px-2 py-8 flex flex-col space-y-3 justify-center text-center text-white">
                            <p class="font-bold">Descubre todas las categorias</p>
                            <i v-if="all_categories" class="fa-solid fa-chevron-up"></i>
                            <i v-else class="fa-solid fa-chevron-down"></i>
                        </div>

                        <div v-if="all_categories" @click="$inertia.get(route('products.index'))"  v-for="categoryCard in categories2" :key="categoryCard" class="cursor-pointer hover:border-[#D90537] hover:scale-105 mt-3 lg:mt-0 rounded-lg border-2 border-[#D90537] px-2 py-8 flex flex-col space-y-3 justify-center text-center">
                            <figure>
                                <img :src="categoryCard.image" :alt="categoryCard.alt">
                            </figure>
                            <p class="text-primary">{{ categoryCard.name }}</p>
                        </div>
                        
                    </div>
                </div>
<!-- --------------------- todas las categorias end ----------------------------- -->


<!-- --------------------- Beneficios de comprar en emblems3d start ----------------------------- -->
                <div class="mt-7">
                    <h2 class="text-xl text-left ">Beneficios de comprar en emblems3d</h2>

                    <div class="mt-5 md:grid grid-cols-4 gap-4 transition ease-linear duration-300">
                        <div @click="safeShippingModal = true" class="py-2 px-4 flex space-x-3 justify-center text-center relative cursor-pointer mt-10 lg:mt-0">
                            <figure>
                                <img src="@/../../public/images/Vector.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Envio seguro</p>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute bottom-0"></div>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute -bottom-2 left-0"></div>
                        </div>

                        <div @click="onTimeModal = true" class="py-2 px-4 flex space-x-3 justify-center text-center relative cursor-pointer mt-10 lg:mt-0">
                            <figure>
                                <img src="@/../../public/images/Vector1.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Entregas a tiempo</p>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute bottom-0"></div>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute -bottom-2 left-0"></div>
                        </div>

                        <div @click="innovationModal = true" class="py-2 px-4 flex space-x-3 justify-center text-center relative cursor-pointer mt-10 lg:mt-0">
                            <figure>
                                <img src="@/../../public/images/Vector2.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Innovacion y tendencia</p>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute bottom-0"></div>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute -bottom-2 left-0"></div>
                        </div>

                        <div @click="qualityModal = true" class="py-2 px-4 flex space-x-3 justify-center text-center relative cursor-pointer mt-10 lg:mt-0">
                            <figure>
                                <img src="@/../../public/images/Vector3.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Calidad de primera</p>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute bottom-0"></div>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute -bottom-2 left-0"></div>
                        </div>
                        
                    </div>
                </div>
<!-- --------------------- Beneficios de comprar en emblems3d end ----------------------------- -->


<!-- --------------------- Marcas principales start ----------------------------- -->
                <div class="mt-7">
                    <h2 class="text-xl text-left ">Marcas principales</h2>

                    <div class="mt-5 md:grid grid-cols-5 gap-4 transition ease-linear duration-300">
                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Honda">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Kia">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Mercedez">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Mini">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="volvo">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg mt-3 lg:mt-0">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="BMW">
                            </figure>
                        </div>

                    </div>
                </div>
<!-- --------------------- Marcas principales end ----------------------------- -->


<!-- --------------------- Productos recomendados start ----------------------------- -->
                <div class="mt-7">
                    <h2 class="text-xl text-left ">Productos recomendados <span class="text-primary hover:underline ml-3 cursor-pointer">ver mas</span></h2>

                    <div class="mt-5 md:grid grid-cols-5 gap-4 transition ease-linear duration-300">
                        <div class="py-5 px-3 flex flex-col space-x-3 justify-center cursor-pointer rounded-lg border text-center border-[#9A9A9A] mt-3 lg:mt-0">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Honda">
                            </figure>
                            <h3 class="font-bold text-lg text-center">Llavero Honda</h3>
                            <p class="text-xs text-">Llavero honda</p>
                            <p class="text-xs text-">Metalico, letra</p>
                            <p class="text-xs text-">SKU: PRO 024N</p>
                            <div class="border-b border-black w-[90%]"></div>
                            <div class="grid grid-cols-2 mt-3">
                                <p class="text-[#9A9A9A] relative">$99.99
                                    <div class="absolute border-r-2 border-[#D90537] h-10 -bottom-2 right-11 rotate-[65deg]"></div>
                                </p>
                                <p class="text-primary">$79.99</p>
                            </div>
                        </div>
                        
                        <div class="py-5 px-3 flex flex-col space-x-3 justify-center cursor-pointer rounded-lg border text-center border-[#9A9A9A] mt-3 lg:mt-0">
                        <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Honda">
                            </figure>
                            <h3 class="font-bold text-lg text-center">Llavero MG</h3>
                            <p class="text-xs text-">Llavero MG</p>
                            <p class="text-xs text-">Color rojo, grabado</p>
                            <p class="text-xs text-">SKU: PRO 024N</p>
                            <div class="border-b border-black w-[90%]"></div>
                            <div class="grid grid-cols-2 mt-3">
                                <p class="text-[#9A9A9A] relative">$95.69
                                    <div class="absolute border-r-2 border-[#D90537] h-10 -bottom-2 right-11 rotate-[65deg]"></div>
                                </p>
                                <p class="text-primary">$70.99</p>
                            </div>
                        </div>
                    </div>
                </div>
<!-- --------------------- Productos recomendados end ----------------------------- -->


<!-- --------------------- Recibe nuestras notificaciones start ----------------------------- -->
                <div class="my-7">
                    <h2 class="text-lg">Recibe nuestras notificaciones</h2>
                    <div class="flex items-center">
                        <input type="text" class="input w-1/2 mr-4" placeholder="Ingresa tu email">
                        <PrimaryButton>Suscribirse</PrimaryButton>
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
                <figure class="my-5 absolute bottom-1 right-4">
                        <img src="@/../../public/images/logo.png" alt="Logo">
                    </figure>
            </div>
            <p class="bg-[#1a1a1a] text-white px-3 pb-2">Copyright 2023. Emblems3dUSA todos los derechos reservados. Políticas de privacidad y administración de cookies</p>
                    
        </footer>

        <!-- -------------- Modal starts----------------------- -->
        <DialogModal :show="safeShippingModal || onTimeModal || innovationModal || qualityModal" 
        @close="safeShippingModal = false; onTimeModal = false; innovationModal = false; qualityModal = false">
                <template #title>
                    <p v-if="safeShippingModal">Envio seguro</p>
                    <p v-else-if="onTimeModal">Entregas a tiempo</p>
                    <p v-else-if="innovationModal">Innovacion y tendencia</p>
                    <p v-else-if="qualityModal">Calidad de primera</p>
                </template>
                <template #content>
                    <p v-if="safeShippingModal">Tu tranquilidad es nuestra prioridad. Te garantizamos que tus productos llegarán a tus manos en perfectas condiciones. </p>
                    <p v-else-if="onTimeModal">El tiempo de nuestros clientes es nuestro tiempo, respetando los lapsos de entrega con compromiso e incluso reduciéndolos.</p>
                    <p v-else-if="innovationModal">Somos referentes para otras empresas por estar en vanguardia, nos actualizamos con la tecnología porque sabemos que los tiempos y las necesidades cambian constantemente.</p>
                    <p v-else-if="qualityModal">Nuestros productos se caracterizan por su alta durabilidad, su resistencia a extremas temperaturas y su portabilidad que le da lujo y representan tu marca.</p>
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
import { Link } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";

import portaplacas from '@/../../public/images/portaplacas.png';

export default {
  data() {
    return {
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
                image: '@/../../public/images/llaveros.png',
                alt: 'Llaveros'
            },
            {
                name: 'Emblemas',
                image: '@/../../public/images/logonegro.png',
                alt: 'Emblemas'
            },
            {
                name: 'Tapetes de uso rudo',
                image: '@/../../public/images/tapete.png',
                alt: 'Tapetes'
            },
            {
                name: 'Porta documentos',
                image: '@/../../public/images/portadocumentos.png',
                alt: 'Portaplacas'
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

  },
  components: {
    AppLayout,
    PrimaryButton,
    Link,
    DialogModal,
    CancelButton,
  },
  methods: {
    async deleteItem() {
      try {
        const response = await axios.delete(
          route("companies.destroy", this.currentCompany?.id)
        );

        if (response.status == 200) {
          this.$notify({
            title: "Éxito",
            message: response.data.message,
            type: "success",
          });

          const index = this.companies.findIndex(
            (item) => item.id === this.currentCompany.id
          );
          if (index !== -1) {
            this.companies.splice(index, 1);
            this.selectedCompany = "";
          }
        } else {
          this.$notify({
            title: "Algo salió mal",
            message: response.data.message,
            type: "error",
          });
        }
      } catch (err) {
        this.$notify({
          title: "Algo salió mal",
          message: err.message,
          type: "error",
        });
        console.log(err);
      } finally {
        this.showConfirmModal = false;
      }
    },
  },

  watch: {
    selectedCompany(newVal) {
      this.currentCompany = this.companies.find((item) => item.id == newVal);
      // this.currentCompanyProducts = this.company_products.data.find((item) => item.company_id == this.selectedCompany);
    },
  },

  mounted() {
    this.selectedCompany = this.company.id;
  },
};
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <figure>
                    <img src="@/../../public/images/banner.png" alt="banner">
                </figure>

                <div class="mt-7">
                    <h2 class="text-xl text-left ">Todas las categorias</h2>

                    <div class="mt-5 md:grid grid-cols-6 gap-4 transition ease-linear duration-300">
                        <div v-for="(categoryCard, index) in categories1" :key="categoryCard" class="rounded-lg border-2 border-[#D90537] px-2 py-8 flex flex-col space-y-3 justify-center text-center">
                            <figure>
                                <img :src="categoryCard.image" :alt="categoryCard.alt">
                            </figure>
                            <p class="text-primary">{{ categoryCard.name }}</p>
                        </div>

                        <div @click="all_categories = !all_categories" class="cursor-pointer rounded-lg border-2 border-[#D90537] bg-primary px-2 py-8 flex flex-col space-y-3 justify-center text-center text-white">
                            <p class="font-bold">Descubre todas las categorias</p>
                            <i v-if="all_categories" class="fa-solid fa-chevron-up"></i>
                            <i v-else class="fa-solid fa-chevron-down"></i>
                        </div>

                        <div v-if="all_categories" v-for="(categoryCard, index) in categories2" :key="categoryCard" class="rounded-lg border-2 border-[#D90537] px-2 py-8 flex flex-col space-y-3 justify-center text-center">
                            <figure>
                                <img :src="categoryCard.image" :alt="categoryCard.alt">
                            </figure>
                            <p class="text-primary">{{ categoryCard.name }}</p>
                        </div>
                        
                    </div>
                </div>

                <div class="mt-7">
                    <h2 class="text-xl text-left ">Beneficios de comprar en emblems3d</h2>

                    <div class="mt-5 md:grid grid-cols-4 gap-4 transition ease-linear duration-300">
                        <div class="py-2 px-4 flex space-x-3 justify-center text-center relative cursor-pointer">
                            <figure>
                                <img src="@/../../public/images/Vector.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Envio seguro</p>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute bottom-0"></div>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute -bottom-2 left-0"></div>
                        </div>

                        <div class="py-2 px-4 flex space-x-3 justify-center text-center relative cursor-pointer">
                            <figure>
                                <img src="@/../../public/images/Vector1.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Entregas a tiempo</p>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute bottom-0"></div>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute -bottom-2 left-0"></div>
                        </div>

                        <div class="py-2 px-4 flex space-x-3 justify-center text-center relative cursor-pointer">
                            <figure>
                                <img src="@/../../public/images/Vector2.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Innovacion y tendencia</p>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute bottom-0"></div>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute -bottom-2 left-0"></div>
                        </div>

                        <div class="py-2 px-4 flex space-x-3 justify-center text-center relative cursor-pointer">
                            <figure>
                                <img src="@/../../public/images/Vector3.png" alt="Envio seguro">
                            </figure>
                            <p class="text-secondary">Calidad de primera</p>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute bottom-0"></div>
                            <div class="border-b-2 border-[#0355B5] w-56 absolute -bottom-2 left-0"></div>
                        </div>
                        
                    </div>
                </div>

                <div class="mt-7">
                    <h2 class="text-xl text-left ">Marcas principales</h2>

                    <div class="mt-5 md:grid grid-cols-5 gap-4 transition ease-linear duration-300">
                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Honda">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Kia">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Mercedez">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="Mini">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="volvo">
                            </figure>
                        </div>

                        <div class="py-2 px-4 bg-[#D9D9D9] flex space-x-3 justify-center items-center cursor-pointer rounded-lg">
                            <figure>
                                <img src="@/../../../../public/storage/images/honda.png" alt="BMW">
                            </figure>
                        </div>

                    </div>
                    
                </div>

                <div class="mt-7">
                    <h2 class="text-xl text-left ">Productos recomendados</h2>

                    <div class="mt-5 md:grid grid-cols-5 gap-4 transition ease-linear duration-300">
                        <div class="py-5 px-3 flex flex-col space-x-3 justify-center cursor-pointer rounded-lg border text-center border-[#9A9A9A]">
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
                                <p class="text-primary">$99.99</p>

                            </div>
                        </div>

            
                    </div>
                    
                </div>

                

            </div>

            
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/vue3";

import portaplacas from '@/../../public/images/portaplacas.png';

export default {
  data() {
    return {
        all_categories: false,
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

<template>
  <AppLayout title="Productos">

    <div class="lg:px-20 lg:py-8">

        <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2 text-sm">
        <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p>Historial de productos</p>
      </div>

      <div class="flex justify-between mb-7">
        <h2 class="font-bold text-lg">Lista de productos</h2>
        <div class="flex items-center space-x-3">
          <div class="flex items-center space-x-2">
              <input v-model="inputSearch" type="search" class="input"
                  placeholder="Buscar" />
              <SecondaryButton @click="handleSearch" type="submit" class=""><i
                      class="fa-solid fa-magnifying-glass"></i></SecondaryButton>
          </div>
          <ThirthButton @click="$inertia.get(route('products.edit'))" class="!text-primary border-[#D90537]"><i class="fa-solid fa-pencil"></i></ThirthButton>
          <PrimaryButton @click="$inertia.get(route('products.create'))">+ Nuevo</PrimaryButton>
        </div>
      </div>

      <div class="border border-[#9A9A9A] rounded-lg p-7">
        <table class="w-full">
              <thead>
                <tr class="text-left">
                  <th class="font-normal pb-5"># parte<i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                  <th class="font-normal pb-5">Nombre del producto <i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                  <th class="font-normal pb-5">Precio <i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                  <th class="font-normal pb-5">Categoría <i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                  <th class="font-normal pb-5">Estatus <i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                  <th class="font-normal pb-5">Stock <i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                </tr>
              </thead>
              <tbody>
                <tr @click="$inertia.get(route('products.show', product.id))" v-for="product in filteredTableData" :key="product" class="mb-4 cursor-pointer hover:bg-[#d9d9d9]">
                  <td class="text-left pb-3 rounded-l-md">
                    {{ product.part_number }}
                  </td>
                  <td class="text-left pb-3">
                    <span class>{{ product.name }}</span>
                  </td>
                  <td class="text-left pb-3">
                    ${{ product.price.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
                  </td>
                  <td class="text-left pb-3">
                    {{ product.category }}
                  </td>
                  <td :class="product.is_active ? 'text-green-500' : 'text-red-500'" class="text-left pb-3">
                    {{ product.is_active ? 'Activo' : 'Inactivo' }}
                  </td>
                  <td class="text-left pb-3 rounded-r-md">
                    {{ product.stock.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
                  </td>
                </tr>
              </tbody>
            </table>
      </div>

    </div>


  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ThirthButton from "@/Components/MyComponents/ThirthButton.vue";

export default {
data(){
    return{
      search: '',
      inputSearch: '',
    }
},
components:{
    AppLayout,
    PrimaryButton,
    SecondaryButton,
    ThirthButton,
},
props:{
  products: Array
},
methods:{
  handleSearch() {
            this.search = this.inputSearch;
        },
},
computed: {
        filteredTableData() {
            if (!this.search) {
                return this.products;
            } else {
                return this.products.filter(
                    (product) =>
                        product.name.toLowerCase().includes(this.search.toLowerCase()) ||
                        product.part_number.toLowerCase().includes(this.search.toLowerCase()) ||
                        product.category.toLowerCase().includes(this.search.toLowerCase())
                )
            }
        }
    },
}
</script>

<style>

</style>
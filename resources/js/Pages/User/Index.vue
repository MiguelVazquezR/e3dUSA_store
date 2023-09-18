<template>
  <AppLayout title="Usuarios">

    <div class="lg:px-20 lg:py-8">

        <!-- ---------------------- directory ------------------------ -->
      <div class="mb-8 flex items-center space-x-2 text-sm">
        <i @click="$inertia.get('/dashboard')" class="fa-solid fa-house text-primary cursor-pointer"></i>
        <i class="fa-solid fa-angle-right text-primary"></i>
        <p>Usuarios</p>
      </div>

      <div class="flex justify-between mb-7">
        <h2 class="font-bold text-lg">Lista de usuarios</h2>
        <div class="flex items-center space-x-3">
          <div class="flex items-center space-x-2">
              <input v-model="inputSearch" type="search" class="input"
                  placeholder="Buscar" />
              <SecondaryButton @click="handleSearch" type="submit" class=""><i
                      class="fa-solid fa-magnifying-glass"></i></SecondaryButton>
          </div>
          <PrimaryButton @click="$inertia.get(route('users.create'))">+ Nuevo</PrimaryButton>
        </div>
      </div>

      <div class="border border-[#9A9A9A] rounded-lg p-7">
        <table class="w-full">
              <thead>
                <tr class="text-left">
                  <th class="font-normal pb-5">#ID<i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                  <th class="font-normal pb-5">Nombre<i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                  <th class="font-normal pb-5">Correo <i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                  <th class="font-normal pb-5">Fecha de registro <i class="fa-solid fa-arrow-down-long ml-3"></i></th>
                </tr>
              </thead>
              <tbody>
                <tr @click="$inertia.get(route('users.show', user.id))" v-for="user in filteredTableData" :key="user" class="mb-4 cursor-pointer hover:bg-[#d9d9d9]">
                  <td class="text-left pb-3 rounded-l-md">
                    {{ user.id }}
                  </td>
                  <td class="text-left pb-3">
                    <span class>{{ user.name }}</span>
                  </td>
                  <td class="text-left pb-3">
                    {{ user.email }}
                  </td>
                  <td class="text-left pb-3 rounded-r-md">
                    {{ user.created_at.split('T')[0] }}
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
  users: Array
},
methods:{
  handleSearch() {
            this.search = this.inputSearch;
        },
},
computed: {
        filteredTableData() {
            if (!this.search) {
                return this.users;
            } else {
                return this.users.filter(
                    (user) =>
                        user.name.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.status.toString().toLowerCase().includes(this.search.toLowerCase()) 
                )
            }
        }
    },
}
</script>

<style>

</style>
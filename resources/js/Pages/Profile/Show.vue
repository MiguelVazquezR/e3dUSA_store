<script setup>
import { ref } from 'vue';
import { Link, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";
import InputError from "@/Components/InputError.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});

const form = useForm({
      type: null,
      bank_name: null,
      account_number: null,
      owner_name: null,
    });

function store(){
    form.post(route('payment-methods.store'));
    addNewCardModal = false;
  }

 const cardTypes = [
        'Tarjeta de crédito',
        'Tarjeta de débito',
      ];

const addNewCardModal = ref(false);

const tabs = ref(1); //1. Perfil  2.mis compras 3. Mis metodos de pago 4. Facturación.
const showOptions = ref(true);
</script>

<template>
    <AppLayout title="Mi cuenta">
    
    <div class="flex space-x-3">
        <div class="border-2 border-[#c9c9c9] rounded-lg w-auto h-full pt-9 pb-32 pl-5 pr-3">
            <div @click="showOptions = !showOptions" class="flex items-center text-secondary font-bold space-x-4 pl-2 cursor-pointer">
                <i class="p-1 fa-solid fa-bars"></i>
                <h2 v-if="showOptions" class="">Mi cuenta</h2>
            </div>
            <div @click="tabs = 1" :class="tabs == 1 ? 'border-l-2 border-[#D90537] text-primary' : '' " class="mt-7 flex items-center font-bold space-x-4 pl-2 cursor-pointer">
                <i class="p-1 fa-regular fa-circle-user"></i>
                <p v-if="showOptions" class="cursor-pointer font-bold flex items-center"> Perfil</p>
            </div>
            <div @click="tabs = 2" :class="tabs == 2 ? 'border-l-2 border-[#D90537] text-primary' : '' " class="mt-7 flex items-center font-bold space-x-4 pl-2 cursor-pointer">
                <i class="p-1 fa-solid fa-cart-shopping"></i>
                <p v-if="showOptions" class="cursor-pointer font-bold flex items-center"> Mis compras</p>
            </div>
            <div @click="tabs = 3" :class="tabs == 3 ? 'border-l-2 border-[#D90537] text-primary' : '' " class="mt-7 flex items-center font-bold space-x-4 pl-2 cursor-pointer">
                <i class="p-1 fa-regular fa-credit-card"></i>
                <p v-if="showOptions" class="cursor-pointer font-bold flex items-center"> Mis métodos de pago</p>
            </div>
            <div @click="tabs = 4" :class="tabs == 4 ? 'border-l-2 border-[#D90537] text-primary' : '' " class="mt-7 flex items-center font-bold space-x-4 pl-2 cursor-pointer">
                <i class="p-1 fa-solid fa-file-invoice"></i>
                <p v-if="showOptions" class="cursor-pointer font-bold flex items-center"> Facturación</p>
            </div>
        </div>
        <div v-if="tabs == 1">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInformationForm :user="$page.props.auth.user" />

                    <SectionBorder />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <UpdatePasswordForm class="mt-10 sm:mt-0" />

                    <SectionBorder />
                </div>

                <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                    <TwoFactorAuthenticationForm
                        :requires-confirmation="confirmsTwoFactorAuthentication"
                        class="mt-10 sm:mt-0"
                    />

                    <SectionBorder />
                </div>

                <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />

                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <SectionBorder />

                    <DeleteUserForm class="mt-10 sm:mt-0" />
                </template>
            </div>
        </div>


<!-- ------------ Tab 2 Mis compras ----------- -->
        <div class="w-full" v-if="tabs == 2">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-16">
                <h1 class="text-xl font-bold mb-2">Compras</h1>
                <div class="flex items-center">
                    <input type="text" placeholder="Buscar" class="input w-72 mr-16">
                    <div class="flex items-center">
                        <i class="fa-solid fa-filter text-sm mr-1"></i>
                        <p>Todas</p>
                        <i class="fa-solid fa-angle-down ml-3"></i>
                    </div>
                    <div class="border-r border-[#9A9A9A] h-7 px-3"></div>
                    <p class="text-[#9A9A9A] pl-4">{{ '5 compras' }}</p>
                </div>  
            </div>
        

        <div class="mt-12 mx-24">
        <!-- ----------- Purchase component -------- -->
            <div class="border border-[#9A9A9A] rounded-lg w-full">
                <div class="flex justify-between items-center px-6 py-3 border-b border-[#9A9A9A]">
                    <p class="font-bold text-lg">Fecha de compra</p>
                    <p class="text-secondary text-sm cursor-pointer">Volver a comprar</p>
                </div>
                <div class="px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <figure class="border border-[#9A9A9A] rounded-md p-1 w-28 h-24">
                            <img src="" alt="">
                        </figure>
                        <div class="pr-12">
                            <p class="text-green-600">En preparación</p>
                            <p class="font-bold">Llegada el 4 Septiembre 2023</p>
                            <p class="text-sm">1,500 pzs Llavero MG</p>
                        </div>
                    </div>
                    <PrimaryButton class="h-7">Ver compra</PrimaryButton>
                </div>
            </div>
        <!-- ----------- Purchase component -------- -->
        </div>            
    </div>


<!-- ------------ Tab 3 Mis métodos de pago ----------- -->
        <div class="w-full" v-if="tabs == 3">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <h1 class="text-secondary font-bold text-lg mb-3">Mis tarjetas de crédito o débito</h1>

            <div class="w-1/2">
            <!-- ------- tarjetas componente ------- -->
                <div class="border border-[#9a9a9a] rounded-lg">
                    <p class="border-b border-[#9a9a9a] px-5 py-2 bg-green-500 text-white rounded-t-lg"><i class="fa-solid fa-check mr-7"></i> Predeterminado</p>
                    <div class="py-5 px-7">
                        <div class="flex items-center">
                            <i class="fa-regular fa-credit-card mr-4"></i>
                            <p class="mr-12">Tarjeta de crédito BBVA</p>
                            <p>4565376251445</p>
                        </div>
                        <div class="flex items-center mt-3">
                            <i class="fa-regular fa-circle-check text-green-500 mr-4"></i>
                            <p class="mr-12">Miguel Vázquez Rodríguez</p>
                        </div>
                        <div class="flex items-center mt-5">
                            <p class="text-[#9a9a9a] cursor-pointer">Editar</p>
                            <div class="border-r border-[#9A9A9A] h-7 mx-3"></div>
                            <p class="text-[#9a9a9a] cursor-pointer">Eliminar</p>
                        </div>
                    </div>
                </div>
            <!-- ------- tarjetas componente ------- -->

            <div @click="addNewCardModal = true" class="border border-[#9a9a9a] rounded-lg cursor-pointer py-3 px-6 flex items-center space-x-2 mt-4">
                +<i class="fa-regular fa-credit-card"></i>
                <p>Agregar tarjeta de crédito o débito</p>
            </div>
            </div>
            </div>
           
        </div>


</div>

<!-- -------------- Add new card modal ------------ -->
<Modal :show="addNewCardModal " @close="addNewCardModal = false">
        <form @submit.prevent="store()" class="mx-7 my-4 space-y-4 relative px-3">
            <div @click="addNewCardModal = false"
                class="cursor-pointer w-5 h-5 rounded-full border-2 border-black flex items-center justify-center absolute top-0 right-0">
                <i class="fa-solid fa-xmark"></i>
              </div>
          <h2 class="text-center">Información bancaria</h2> 

            <div class="mb-4">
          <select v-model="form.type" class="input">
            <option v-for="cardType in cardTypes" :key="cardType" :value="cardType">{{ cardType }}</option>
          </select>
          <InputError :message="form.errors.type" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.bank_name">Nombre del banco *</InputWithPlaceholder>
          <InputError :message="form.errors.bank_name" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.account_number">Número de cuenta *</InputWithPlaceholder>
          <InputError :message="form.errors.account_number" />
        </div>
        <div class="mb-4">
          <InputWithPlaceholder v-model="form.owner_name">Nombre del dueño de la cuenta *</InputWithPlaceholder>
          <InputError :message="form.errors.owner_name" />
        </div>
          
          <!-- -------- Buttons ----- -->
          <div class="flex justify-end space-x-3 pt-5 pb-1">
            <PrimaryButton :disabled="form.processing">Agregar</PrimaryButton>
            <CancelButton @click="addNewCardModal = false">Cancelar</CancelButton>
          </div>
        </form>
      </Modal>
    </AppLayout>
</template>

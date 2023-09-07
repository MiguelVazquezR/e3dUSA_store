<script setup>
import { ref } from 'vue';
import { Link, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";
import InputError from "@/Components/InputError.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import ThirthButton from "@/Components/MyComponents/ThirthButton.vue";
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

const invoiceForm = useForm({
      name: null,
      patern_last_name: null,
      mother_last_name: null,
      rfc: null,
      tax_regime: null,
      cfdi_use: null,
      postal_code: null,
      street: null,
      outdoor_number: null,
      interior_number: null,
      colony: null,
      city_halll: null,
      city: null,
      state: null,
      email: null,
      phone: null,
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
const invoiceTab = ref(1); //1. perdona fisica  2.Persona moral
const showOptions = ref(false);
</script>

<template>
    <AppLayout title="Mi cuenta">
    <div class="pb-16">

        <!-- -------------------- responsiv perfil nav -------------------- -->
        <div class="lg:hidden border-2 border-[#c9c9c9] rounded-lg w-full py-1 px-2 justify-center flex space-x-4">
            <div @click="showOptions = !showOptions" class="flex flex-colitems-center text-secondary font-bold space-x-4">
                <i class="p-1 fa-solid fa-bars"></i>
            </div>
            <div @click="tabs = 1" :class="tabs == 1 ? 'border-b-2 border-[#D90537] text-primary' : '' " class="flex flex-col items-center font-bold">
                <i class="p-1 fa-regular fa-circle-user"></i>
                <p v-if="showOptions" class="font-bold flex items-center text-xs"> Perfil</p>
            </div>
            <div @click="tabs = 2" :class="tabs == 2 ? 'border-b-2 border-[#D90537] text-primary' : '' " class="flex flex-col items-center font-bold">
                <i class="p-1 fa-solid fa-cart-shopping"></i>
                <p v-if="showOptions" class="font-bold flex items-center text-xs"> Mis compras</p>
            </div>
            <div @click="tabs = 3" :class="tabs == 3 ? 'border-b-2 border-[#D90537] text-primary' : '' " class="flex flex-col items-center font-bold">
                <i class="p-1 fa-regular fa-credit-card"></i>
                <p v-if="showOptions" class="font-bold flex items-center text-xs">Info de pago</p>
            </div>
            <div @click="tabs = 4" :class="tabs == 4 ? 'border-b-2 border-[#D90537] text-primary' : '' " class="flex flex-col items-center font-bold">
                <i class="p-1 fa-solid fa-file-invoice"></i>
                <p v-if="showOptions" class="font-bold flex items-center text-xs">Facturación</p>
            </div>
        </div>
    
    <div class="flex space-x-3">
        <!-- --------------------- lateral nperfil nav large screen -------------------- -->
        <div class="hidden lg:block border-2 border-[#c9c9c9] rounded-lg w-auto h-full pt-9 pb-32 pl-4 pr-3">
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
        <!-- ---------------- tab 1 perfil ------------ -->
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
                <h1 class="lg:text-xl font-bold mb-1">Mis compras</h1>
                <div class="flex items-center text-sm lg:text-base">
                    <input type="text" placeholder="Buscar" class="input lg:w-72 lg:mr-16">
                    <div class="flex justify-between items-center mx-4 px-5 lg:mx-0">
                        <i class="fa-solid fa-filter text-sm mr-1"></i>
                        <p>Todas</p>
                        <i class="fa-solid fa-angle-down ml-3"></i>
                    </div>
                    <div class="hidden lg:block border-r border-[#9A9A9A] h-7 px-3"></div>
                    <p class="hidden lg:block text-[#9A9A9A] pl-4">{{ '5 compras' }}</p>
                </div>  
            </div>
        
        <div class="lg:mt-12 lg:mx-24 pr-2">
        <!-- ----------- Purchase component -------- -->
            <div class="border border-[#9A9A9A] rounded-lg w-full">
                <div class="flex justify-between items-center px-3 py-1 border-b border-[#9A9A9A]">
                    <p class="font-bold lg:text-lg">Fecha de compra</p>
                    <p class="text-secondary text-xs lg:text-sm cursor-pointer">Volver a comprar</p>
                </div>
                <div class="px-3 py-2 flex items-center justify-between text-xs lg:text-base">
                    <div class="flex items-center space-x-3">
                        <figure class="border border-[#9A9A9A] rounded-md p-1 w-28 h-24">
                            <img src="" alt="">
                        </figure>
                        <div class="lg:pr-12 pr-2">
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

        <!-- ------------------ purchase details ----------------- -->
        <div class="lg:mx-12 mt-9 mb-3 pr-2">
            <h1 class="lg:text-xl font-bold mb-3">Detalles del pedido</h1>
            <div class="border border-[#9a9a9a] rounded-lg py-4 px-8">
                <h3 class="text-green-400 mb-4">Entregado</h3>
                <p class="mb-2 text-xs lg:text-sm"><i class="fa-regular fa-user mr-2"></i>Cristina Gutierrez Gonzalez</p>
                <p class="mb-2 text-xs lg:text-sm"><i class="fa-solid fa-phone mr-2"></i>3312454477</p>
                <p class="mb-2 text-xs lg:text-sm"><i class="fa-solid fa-location-dot mr-2"></i>Marina Vallarta #1500, Jardines del valle, Zapopan Jalisco</p>
                <p class="mb-2 text-xs lg:text-sm"><i class="fa-solid fa-file-invoice mr-2"></i>Oficinas Honda Jardines del Valle </p>
                <ThirthButton class="!rounded-full mt-3">Volver a comprar</ThirthButton>
            </div>
        </div>    

        <!-- ------------------ Payment details ----------------- -->
        <div class="lg:mx-12 mt-9 mb-3 pr-2">
            <h1 class="lg:text-xl font-bold mb-3">Detalles del pago</h1>
            <div class="lg:flex lg:space-x-7 space-y-3 lg:space-y-0">
                <div class="lg:w-1/2 border border-[#9a9a9a] rounded-lg py-4 px-8">
                    <div class="border-b border-[#9A9A9A] text-[#9A9A9A] flex justify-between py-1">
                        <p>06 Junio 2022</p>
                        <div class="border-r border-[#9A9A9A] mx-2"></div>
                        <p>#93884762930</p>
                    </div>
                    <div class="flex justify-between text-[#9A9A9A] my-2">
                        <p>Productos (100)</p>
                        <p>$19,500.90</p>
                    </div>
                    <div class="flex justify-between text-[#9A9A9A] my-2">
                        <p>Descuento</p>
                        <p>$0.00</p>
                    </div>
                    <div class="flex justify-between text-[#9A9A9A] my-2">
                        <p>Envío</p>
                        <p>$69.70</p>
                    </div>
                    <div class="flex justify-between my-2">
                        <p>Total</p>
                        <p>$19,570.20</p>
                    </div>
                    <p class="text-xs text-right text-[#9A9A9A]">Visa Débito ******3452</p>
                </div>
                <div class="lg:w-1/2 border border-[#9a9a9a] rounded-lg py-4 px-8 flex items-center">
                    <div class="w-1/4">
                        <figure>
                            <img src="@/../../public/images/visa.png" alt="">
                        </figure>
                    </div>
                    <div class="w-3/4 py-5 px-3">
                        <p class="text-[#9A9A9A]">$678</p>
                        <p class="text-[#9A9A9A]">Visa Débito ****3452</p>
                        <p class="text-[#9A9A9A]">06 Junio 2022 | #94455638721278</p>
                        <p class="text-green-500">Pago aprobado</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:mx-12 mt-9 mb-3 pr-2">
            <h1 class="lg:text-xl font-bold mb-3">Productos</h1>
            <div class="border border-[#9A9A9A] rounded-lg py-2 px-4 flex justify-between items-center lg:text-sm text-xs">
                <div class="flex items-center space-x-3">
                        <figure class="border border-[#9A9A9A] rounded-md p-1 w-28 h-24">
                            <img src="" alt="">
                        </figure>
                        <div class="lg:pr-12 pr-2">
                            <p class="font-bold">Llegada el 4 Septiembre 2023</p>
                            <p class="text-sm">1,500 pzs Llavero MG</p>
                        </div>
                    </div>
                        <p class="text-primary text-right lg:mr-9">Ver producto</p>
            </div>
        </div>         
    </div>


<!-- ------------ Tab 3 Mis métodos de pago ----------- -->
        <div class="w-full" v-if="tabs == 3">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <h1 class="text-secondary font-bold text-lg mb-3">Mis tarjetas de crédito o débito</h1>

            <div class="lg:w-1/2 pr-2">
            <!-- ------- tarjetas componente ------- -->
                <div class="border border-[#9a9a9a] rounded-lg">
                    <p class="border-b border-[#9a9a9a] px-5 py-2 bg-green-500 text-white rounded-t-lg"><i class="fa-solid fa-check mr-7"></i> Predeterminado</p>
                    <div class="py-5 px-7 text-sm">
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

            <div @click="addNewCardModal = true" class="border border-[#9a9a9a] rounded-lg cursor-pointer py-3 lg:px-6 px-1 flex items-center space-x-2 mt-4 text-sm">
                +<i class="fa-regular fa-credit-card"></i>
                <p>Agregar tarjeta de crédito o débito</p>
                <figure>
                    <img src="@/../../public/images/visa.png" alt="">
                </figure>
                <figure>
                    <img src="@/../../public/images/master_card.png" alt="">
                </figure>
                <figure>
                    <img src="@/../../public/images/american_express.png" alt="">
                </figure>
            </div>
            </div>
            </div>
           
        </div>


<!-- ------------ Tab 4 Facturación ----------- -->
        <div class="w-full" v-if="tabs == 4">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 pr-2">
                <h1 class="text-secondary font-bold text-lg mb-3">Datos de facturación</h1>
                
                <form @submit.prevent="storeInvoice" class="mx-2 lg:mx-7 my-4 space-y-4 relative lg:px-3 text-sm lg:text-base">
          <h2 class="text-center">Datos de facturación</h2> 

          <div class="flex justify-center border-b border-[#9A9A9A] mx-7 lg:w-1/2 lg:mx-auto text-center">
            <p @click="invoiceTab = 1" :class="invoiceTab == 1 ? 'border-b-2 border-[#D90537]' : ''" class="text-[#9A9A9A] px-4 cursor-pointer">Persona física</p>
            <p @click="invoiceTab = 2" :class="invoiceTab == 2 ? 'border-b-2 border-[#D90537]' : ''" class="text-[#9A9A9A] px-4 cursor-pointer">Persona moral</p>
          </div>

          <!-- ---------------- Persona fisica ----------- -->

            <div v-if="invoiceTab == 1" class="lg:flex space-y-2 space-x-1 pt-5">
                  <InputWithPlaceholder v-model="invoiceForm.name">Nombre(s) *</InputWithPlaceholder>
                  <InputError :message="invoiceForm.errors.name" />
                  <InputWithPlaceholder v-model="invoiceForm.patern_last_name">Apellido paterno *</InputWithPlaceholder>
                  <InputError :message="invoiceForm.errors.patern_last_name" />
                  <InputWithPlaceholder v-model="invoiceForm.mother_last_name">Apellido materno *</InputWithPlaceholder>
                  <InputError :message="invoiceForm.errors.mother_last_name" />
            </div>

            <div v-if="invoiceTab == 2" class="flex space-x-1 pt-5">
                  <select class="input" v-model="invoiceForm.tax_regime">
                    <option selected disabled>--- Razon Social ---</option>
                    <option v-for="tax_regime in tax_regimes" :key="tax_regime" :value="tax_regime">{{ tax_regime }}</option>
                  </select>
            </div>
          
            <div class="flex space-x-1">
                  <InputWithPlaceholder v-model="invoiceForm.rfc">RFC *</InputWithPlaceholder>
                  <InputError :message="invoiceForm.errors.rfc" />
                  <select class="input" v-model="invoiceForm.tax_regime">
                    <option selected disabled>--- Régimen fiscal ---</option>
                    <option v-for="tax_regime in tax_regimes" :key="tax_regime" :value="tax_regime">{{ tax_regime }}</option>
                  </select>
                  <InputError :message="invoiceForm.errors.tax_regime" />
            </div>
                  <select class="input lg:w-1/2" v-model="invoiceForm.cfdi_use">
                    <option selected disabled>--- Uso de CFDI ---</option>
                    <option v-for="tax_regime in tax_regimes" :key="tax_regime" :value="tax_regime">{{ tax_regime }}</option>
                  </select>
                  <InputError :message="invoiceForm.errors.cfdi_use" />

                  <h3 class="text-secondary pt-5">Dirección Fiscal</h3>

                  <div class="lg:flex space-y-2 space-x-1">
                    <InputWithPlaceholder v-model="invoiceForm.postal_code">Código postal *</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.postal_code" />
                    <InputWithPlaceholder v-model="invoiceForm.street">Calle *</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.street" />
                    <InputWithPlaceholder v-model="invoiceForm.outdoor_number">N° exterior *</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.outdoor_number" />
                    <InputWithPlaceholder v-model="invoiceForm.interior_number">N° interior</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.interior_number" />
                  </div>

                  <div class="flex space-x-1">
                    <InputWithPlaceholder v-model="invoiceForm.colony">Colonia *</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.colony" />
                    <InputWithPlaceholder v-model="invoiceForm.city_halll">Municipio *</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.city_halll" />
                  </div>

                  <div class="flex space-x-1">
                    <InputWithPlaceholder v-model="invoiceForm.city">Ciudad *</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.city" />
                    <InputWithPlaceholder v-model="invoiceForm.state">Estado *</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.state" />
                  </div>

                  <h3 class="text-secondary pt-5">Otros datos</h3>

                  <div class="flex space-x-1">
                    <InputWithPlaceholder v-model="invoiceForm.email">Correo electrónico</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.email" />
                    <InputWithPlaceholder v-model="invoiceForm.phone">Teléfono</InputWithPlaceholder>
                    <InputError :message="invoiceForm.errors.phone" />
                  </div>
          

          <!-- -------- Buttons ----- -->
          <div class="flex justify-end space-x-3 pt-5 pb-1">
            <PrimaryButton :disabled="invoiceForm.processing">Aceptar</PrimaryButton>
            <CancelButton @click="invoiceModal = false">Cancelar</CancelButton>
          </div>
        </form>
        <h2 class="text-secondary mb-3 font-bold">Puntos a considerar en la factura</h2>
        <ul>
            <li class="text-sm">-Si es solicitud nueva de factura se enviará a tu correo electrónico en un lapso de 24 hrs. posterior a que envíes tus datos y tu pedido se haya entrego.</li>
            <li class="text-sm">-Una vez que se genere tu factura se enviará a tu correo electrónico, por favor revisar carpeta de spam y/o correos no deseados, para encontrar tu factura.</li>
            <li class="text-sm">-La factura se tramita en el mismo mes en que se realiza la compra, posterior a dicho periodo no podrá ser emitida. Por lo que te sugerimos solicitarla durante la confirmación de tu compra. </li>
            <li class="text-sm">-Si solicitas tu factura posterior a los 30 días naturales de entrega, ésta ya no podrá ser emitida por nuestro Sistema. Te sugerimos tomes tus precauciones y la solicites en cuanto recibas tu pedido. </li>
        </ul>
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
      </div>
    </AppLayout>
</template>

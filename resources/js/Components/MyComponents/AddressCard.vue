<template>
  <div class="flex border border-[#9A9A9A] rounded-lg py-5 px-4 items-center text-sm my-2">
            <div class="w-12">
                <input type="radio" name="shipping_address" class="checked:bg-primary focus:ring-[#D90537]">
            </div>
            <div>
                <p class="font-bold">{{ address.address + ', ' + address.postal_code + '. ' + address.city + ', ' + address.state + ', ' + address.country }}</p>
                <p class=""><strong>Número de teléfono: </strong>{{ address.phone }}</p>
                <p class=""><strong>Nombre de quien recibe: </strong>{{ address.receiver_name }}</p>

                <div class="flex items-center mt-4 lg:ml-5 text-xs lg:text-sm text-gray-600">
                  <p @click="deleteConfirm = true" class="cursor-pointer">Eliminar</p>
                  <div class="border-r border-[#9A9A9A] h-6 mx-3 "></div>
                  <p @click="$inertia.get(route('addresses.edit', address.id))" class="cursor-pointer">Editar</p>
                  <div class="border-r border-[#9A9A9A] h-6 mx-3 "></div>
                  <p class="cursor-pointer">Agregar instrucciones de entrega</p>
                </div>
            </div>

          </div>

          <!-- -------------- Modal starts----------------------- -->
        <DialogModal :show="deleteConfirm" 
        @close="deleteConfirm = false">
                <template #title>
                    <p v-if="deleteConfirm"><i class="fa-solid fa-circle-exclamation text-red-600 mr-2"></i> ¿Continuar con la eliminación?</p>
                </template>
                <template #content>
                    <p v-if="deleteConfirm">Estas a punto de eliminar la dirección guardada. ¿Deseas continuar?</p>
                </template>
                <template #footer>
                    <CancelButton @click="deleteConfirm = false">
                        Cerrar</CancelButton>
                        <PrimaryButton @click="deleteItem" v-if="deleteConfirm">Eliminar</PrimaryButton>
                </template>
            </DialogModal>
            <!-- --------------------------- Modal ends ------------------------------------ -->
</template>

<script>
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";

export default {
data(){
    return{
        deleteConfirm: false,
    }
},
props:{
    address: Object
},
components:{
    DialogModal,
    PrimaryButton,
    CancelButton
},
methods:{
    deleteItem(){
    this.$inertia.delete(route('addresses.destroy', this.address.id));
  }
},
}
</script>

<style>

</style>
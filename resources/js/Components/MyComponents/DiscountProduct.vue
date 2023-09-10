<template>
  <div @click="$inertia.get(route('products.show', discount_product.id))" class="py-5 px-3 flex flex-col space-x-3 justify-center cursor-pointer rounded-lg border text-center border-[#9A9A9A] mt-3 lg:mt-0">
    <figure>
      <img :src="discount_product.media[0]?.original_url" alt="" class="object-contain bg-no-repeat w-52 h-36">
    </figure>
    <h3 class="font-bold text-lg text-center">{{ discount_product?.name }}</h3>
    <p class="text-xs text-">{{ discount_product?.description }}</p>
    <p class="text-xs text-">{{ discount_product?.features }}</p>
    <p class="text-xs text-">{{ discount_product?.part_number }}</p>
    <div class="border-b border-black w-[90%]"></div>
    <div class="grid grid-cols-2 mt-3">
      <p class="text-[#9A9A9A] relative">${{ discount_product?.price.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
          <div class="absolute border-r border-[#D90537] h-12 -bottom-3 right-11 rotate-[65deg]"></div>
     </p>
      <p class="text-primary font-bold">
        ${{discount_product?.is_percentage ? (discount_product?.price * (100 - discount_product?.discount) * 0.01).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            : (discount_product?.price - discount_product?.discount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },
    props:{
        discount_product: Object
    },
    components:{

    },
    methods:{

    },
};
</script>

<style></style>

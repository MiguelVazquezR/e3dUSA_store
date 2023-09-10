<template>
  <div class="w-full bg-[#c9c9c9] rounded-r-lg h-[500px] border border-[#b3b2b2] p-5 text-sm">
    <p @click="showHome = !showHome" class="mt-3 flex items-center cursor-pointer font-bold"><i class="fa-solid fa-house text-lg mr-3"></i>
    Inicio 
    <i :class="showHome ? 'fa-angle-down' : 'fa-angle-right' " class="fa-solid  ml-5"></i></p>
    <ul v-if="showHome" class="ml-6">
        <li @click="$inertia.visit(home_option.route)" class="hover:text-white hover:bg-primary px-2 cursor-pointer rounded-lg" v-for="home_option in home_options" :key="home_option">{{ home_option.label }}</li>
    </ul>
    <p @click="showProducts = !showProducts" class="mt-3 flex items-center cursor-pointer font-bold"><i class="fa-solid fa-boxes-stacked text-lg mr-3"></i>
    Productos 
    <i :class="showProducts ? 'fa-angle-down' : 'fa-angle-right' " class="fa-solid  ml-5"></i></p>
    <ul v-if="showProducts" class="ml-6">
        <li @click="$inertia.visit(product_option.route)" class="hover:text-white hover:bg-primary px-2 cursor-pointer rounded-lg" v-for="product_option in products_options" :key="product_option">{{ product_option.label }}</li>
    </ul>
    <p @click="showSales = !showSales" class="mt-3 flex items-center cursor-pointer font-bold"><i class="fa-solid fa-store text-lg mr-3"></i>
    Vetas 
    <i :class="showSales ? 'fa-angle-down' : 'fa-angle-right' " class="fa-solid  ml-5"></i></p>
    <ul v-if="showSales" class="ml-6">
        <li class="hover:text-white hover:bg-primary px-2 cursor-pointer rounded-lg" v-for="sale_option in sales_options" :key="sale_option">{{ sale_option }}</li>
    </ul>
    <p @click="$inertia.get(route('users.index'))" class="mt-3 flex items-center cursor-pointer font-bold"><i class="fa-solid fa-users text-lg mr-3"></i>Usuarios</p>
    <p @click="showSales = !showSales" class="mt-3 flex items-center cursor-pointer font-bold"><i class="fa-solid fa-clipboard-check text-lg mr-3"></i>Inventario</p>


  </div>
</template>

<script>
export default {
    data(){
        return{
            showHome: true,
            showSales: true,
            showProducts: true,
            home_options:[
                {
                    label: 'Banner',
                    route: ''
                },
                {
                    label: 'Categorías',
                    route: ''
                },
                {
                    label: 'Beneficios',
                    route: ''
                },
                {
                    label: 'Marcas principales',
                    route: ''
                },
                {
                    label: 'Recomendados',
                    route: ''
                },
                {
                    label: 'Footer',
                    route: ''
                },
            ],
            products_options:[
                {
                    label: 'Nuevo producto',
                    route: '/products/create',
                },
                {
                    label: 'Todos los productos',
                    route:  '/products-index-admin',
                },
                {
                    label: 'Filtro',
                    route: '/products-index-admin',
                },
            ],
            sales_options:[
                'Historial',

            ],
        }
    },
    components:{

    },
    props:{

    },
    methods:{

    },
}
</script>

<style>

</style>
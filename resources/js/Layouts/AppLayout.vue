<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ThirthButton from '@/Components/MyComponents/ThirthButton.vue';
import SideNav from '@/Components/MyComponents/SideNav.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);
const showSideNav = ref(false);
const searchTerm = ref("");
const searchResults = ref([]);
const isFocused = ref(false);
const showCategories = ref(false);
const categories = [
    {
        label:'Portaplas',
        route:'ruta',
    },
    {
        label:'Llavero',
        route:'ruta',
    },
    {
        label:'Emblemas',
        route:'ruta',
    },
    {
        label:'Tapetes',
        route:'ruta',
    },
    {
        label:'Portadocumentos',
        route:'ruta',
    },
    {
        label:'Perfumeros',
        route:'ruta',
    },
    {
        label:'Otros',
        route:'ruta',
    },
];

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};

const showSideNavToggle = () => {
  showSideNav.value = !showSideNav.value;
};

 const search = () => {
      // Aquí puedes realizar una solicitud asincrónica al servidor para buscar resultados
      // y actualizar la lista de resultados.
      // Por ejemplo, puedes utilizar Axios para hacer la solicitud a tu API Laravel.
      // Axios.get('/api/search', { params: { query: searchTerm.value } })
      //   .then(response => {
      //     searchResults.value = response.data;
      //   })
      //   .catch(error => {
      //     console.error(error);
      //   });

      // En este ejemplo, se simula una lista de resultados de búsqueda.
      // Debes reemplazar esto con una llamada a tu API real.
      searchResults.value = [
        { id: 1, name: "Producto 1" },
        { id: 2, name: "Producto 2" },
        { id: 3, name: "Producto 3" },
      ];
    };

    const selectResult = (result) => {
      // Maneja la selección de un resultado (por ejemplo, redirigir a la página del producto).
      console.log("Resultado seleccionado:", result);
    };

    const closeResults = () => {
      // Cierra la lista de resultados cuando el input pierde el foco
      isFocused.value = false;
      console.log(isFocused)
    };

    // Observa cambios en isFocused y limpia los resultados cuando pierde el foco
    watch(isFocused, (newVal) => {
      if (!newVal) {
        searchResults.value = [];
      }
    });
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-transparent">
            <!-- ----------------- responsive nav ------------------------- -->
            <nav class="bg-black border-b border-gray-200 lg:hidden py-2 px-5">
                <!-- Logo -->
                <div class="flex items-center justify-center">
                    <Link :href="route('dashboard')">
                        <ApplicationMark class="w-auto" />
                    </Link>
                </div>
                <div>
                                <div class="relative">
                                <input
                                    type="text"
                                    placeholder="Buscar"
                                    class="input bg-gray-100 pr-6 h-8 mt-2"
                                    v-model="searchTerm"
                                    @input="search"
                                    @focus="isFocused = true"
                                    @blur="isFocused = false"
                                    ref="searchInput"
                                />
                                <i class="fa-solid fa-magnifying-glass absolute text-sm text-[#9A9A9A] top-[9px] right-2"></i>
                                </div>

                                <!-- Lista de resultados -->
                                <ul v-if="searchResults.length && isFocused" class="bg-gray-200 border border-gray-300 shadow-md rounded-md absolute w-[350px] p-1">
                                <li class="cursor-pointer hover:bg-gray-300 px-3 rounded-full py-1" v-for="result in searchResults" :key="result.id" @click="selectResult(result)">
                                    {{ result.name }}
                                </li>
                                </ul>
                            </div>
                                       
            </nav>

            <!-- ----------------------- nav lg-screen ------------------------ -->
            <nav class="bg-gray-100 border-b border-gray-200 hidden lg:block">
                <!-- Primary Navigation Menu -->
                <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20 mt-3 lg:mt-0">
                        <div class="flex space-x-7 items-center">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center justify-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationMark class="w-auto" />
                                </Link>
                            </div>
<!-- 
                            <div class="text-[#9A9A9A] text-xs absolute top-1 right-40 flex space-x-5 hidden lg:block">
                                <p class="hover:underline cursor-pointer">Ayuda</p>
                                <p class="hover:underline cursor-pointer"><i class="fa-brands fa-whatsapp mr-1"></i>3312177855</p>
                            </div> -->
                            
                            <div class="relative">
                                <ThirthButton @click="showCategories = !showCategories" class="h-7 lg:flex items-center hidden lg:block">Categorias <i class="fa-solid fa-angle-down ml-2"></i></ThirthButton>
                                <ul v-if="showCategories" class="bg-gray-200 border border-gray-300 shadow-md rounded-md absolute p-1 w-40 text-sm z-30">
                                    <li class="cursor-pointer hover:bg-gray-300 px-3 py-1 rounded-full" v-for="category in categories" :key="category" @click="selectResult(result)">
                                        {{ category.label }}
                                    </li>
                                </ul>
                            </div>
                           <div>
                                <div class="relative">
                                <input
                                    type="text"
                                    placeholder="Buscar"
                                    class="input lg:w-[600px] pr-6"
                                    v-model="searchTerm"
                                    @input="search"
                                    @focus="isFocused = true"
                                    @blur="isFocused = false"
                                    ref="searchInput"
                                />
                                <i class="fa-solid fa-magnifying-glass absolute text-sm text-[#9A9A9A] top-[9px] right-2"></i>
                                </div>

                                <!-- Lista de resultados -->
                                <ul v-if="searchResults.length && isFocused" class="bg-gray-200 border border-gray-300 shadow-md rounded-md absolute w-[600px] p-1">
                                <li class="cursor-pointer hover:bg-gray-300 px-3 rounded-full py-1" v-for="result in searchResults" :key="result.id" @click="selectResult(result)">
                                    {{ result.name }}
                                </li>
                                </ul>
                            </div>
                            
                            
                            <!-- Navigation Links -->
                            <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div> -->
                            
                            <div class="hidden lg:block">
                                <p v-if="$page.props.auth?.user?.name" class="text-primary mx-4">Bienvenido {{ $page.props.auth?.user?.name }}</p>
                                <Link v-else :href="login"><p class="text-primary mx-4 hover:underline">Iniciar sesion</p></Link>
                            </div>

                            <!-- ---- Shopping cart icon ---- -->
                            <Link :href="route('carts.index')">
                                <div class="rounded-full bg-primary h-8 w-8 flex items-center justify-center cursor-pointer relative">
                                    <i class="fa-solid fa-cart-shopping text-sm text-white"></i>
                                    <div v-if="$page.props.auth.user.cart_products.length > 0" class="absolute rounded-full border-2 border-white -top-1 -right-2 bg-secondary text-white text-[9px] h-4 w-4 flex justify-center text-center">{{ $page.props.auth.user.cart_products.length }}</div>
                                </div>
                            </Link>

                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- Teams Dropdown -->
                                <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ $page.props.auth?.user?.current_team.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Team
                                            </div>

                                            <!-- Team Settings -->
                                            <DropdownLink :href="route('teams.show', $page.props.auth.user.current_team)">
                                                Team Settings
                                            </DropdownLink>

                                            <DropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">
                                                Create New Team
                                            </DropdownLink>

                                            <!-- Team Switcher -->
                                            <template v-if="$page.props.auth.user.all_teams.length > 1">
                                                <div class="border-t border-gray-200" />

                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Switch Teams
                                                </div>

                                                <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <DropdownLink as="button">
                                                            <div class="flex items-center">
                                                                <svg v-if="team.id == $page.props.auth.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>

                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </DropdownLink>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Opciones de cuenta
                                        </div>

                                        <DropdownLink :href="route('profile.show')">
                                            Mi cuenta
                                        </DropdownLink>

                                        <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                            API Tokens
                                        </DropdownLink>

                                        <div class="border-t border-gray-200" />

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Cerrar sesión
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Inicio
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ $page.props.auth.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                                Mi cuenta
                            </ResponsiveNavLink>

                            <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                                API Tokens
                            </ResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <ResponsiveNavLink as="button">
                                    Cerrar sesión
                                </ResponsiveNavLink>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200" />

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <ResponsiveNavLink :href="route('teams.show', $page.props.auth.user.current_team)" :active="route().current('teams.show')">
                                    Team Settings
                                </ResponsiveNavLink>

                                <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')" :active="route().current('teams.create')">
                                    Create New Team
                                </ResponsiveNavLink>

                                <!-- Team Switcher -->
                                <template v-if="$page.props.auth.user.all_teams.length > 1">
                                    <div class="border-t border-gray-200" />

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Switch Teams
                                    </div>

                                    <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                        <form @submit.prevent="switchToTeam(team)">
                                            <ResponsiveNavLink as="button">
                                                <div class="flex items-center">
                                                    <svg v-if="team.id == $page.props.auth.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <div>{{ team.name }}</div>
                                                </div>
                                            </ResponsiveNavLink>
                                        </form>
                                    </template>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="bg-gray-100">
                <div class="overflow-hidden bg-gray-100 flex justify-between">
                        <aside v-if="$page.props.auth.user.is_admin" class="hidden lg:block" :class="showSideNav ? 'w-[10%] relative  transition-transform ease-out duration-500' : '' ">
                            <SideNav v-if="showSideNav" />
                            <!-- --- Pestaña con sidenav oculto --- -->
                                <div v-if="!showSideNav" @click="showSideNavToggle" class="bg-[#c9c9c9] hover:scale-105 text-gray-600 w-7 h-12 cursor-pointer flex items-center justify-center rounded-r-lg">
                                    <i class="fa-solid fa-angles-right"></i>
                                </div>
                                <!-- --- Pestaña con sinav acivo --- -->
                                <div v-if="showSideNav" @click="showSideNavToggle" class="absolute -top-7 -right-6 bg-[#c9c9c9] hover:scale-105 text-gray-600 w-7 h-12 cursor-pointer mt-7 flex items-center justify-center rounded-r-lg">
                                    <i class="fa-solid fa-angles-left"></i>
                                </div>
                        </aside>
                        <div :class="showSideNav ? 'w-[90%] transition-margin ease-in duration-500' : 'w-full' ">
                            <slot />
                        </div>
                </div>
                <footer class="hidden lg:block">
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
                <a href="https://dtw.com.mx/" target="_blank">
        <figure class="my-5 absolute -bottom-5 right-4">
          <img class="w-[35%]" src="@/../../public/images/logo-dtw.png" alt="Logo" />
        </figure>
        </a>
            </div>
            <p class="bg-[#1a1a1a] text-white px-3 pb-2">Copyright 2023. Emblems3dUSA todos los derechos reservados. Políticas de privacidad y administración de cookies</p>
                    
        </footer>

        <!-- ---------------- footer nave mobile view --------------- -->
        <nav class="lg:hidden fixed bottom-0 w-full z-10">
            <div class="w-full h-16 flex justify-center px-4 bg-black space-x-6">
                <div @click="$inertia.get(route('dashboard'))" :class="route().current('dashboard') ? 'text-primary border-t-[4px] border-[#D90537]' : 'text-white'" class="flex flex-col justify-center text-center px-2">
                    <i class="fa-solid fa-house text-xl"></i>
                    <p class="text-xs">Inicio</p>
                </div>
                <div @click="$inertia.get(route('profile.show'))" :class="route().current('profile.*') ? 'text-primary border-t-[4px] border-[#D90537]' : 'text-white'" class="flex flex-col justify-center text-center px-2">
                    <i class="fa-regular fa-circle-user text-xl"></i>
                    <p class="text-xs">Mi cuenta</p>
                </div>
                <div @click="$inertia.get(route('carts.index'))" :class="route().current('carts.*') ? 'text-primary border-t-[4px] border-[#D90537]' : 'text-white'" class="flex flex-col justify-center text-center px-2">
                    <i class="fa-solid fa-cart-shopping text-xl"></i>
                    <p class="text-xs">Carrito</p>
                </div>
                <div class="flex flex-col justify-center text-center text-white">
                    <i class="fa-solid fa-bars text-xl "></i>
                    <p class="text-xs">Categorías</p>
                </div>
            </div>  
        </nav>
            </main>
        </div>
    </div>  
</template>

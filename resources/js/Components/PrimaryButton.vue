<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-full font-semibold text-xs text-white tracking-widest hover:bg-primary-light focus:bg-primary-light active:bg-primary-light focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-60 disabled:cursor-not-allowed">
        <slot />
    </button>
</template>

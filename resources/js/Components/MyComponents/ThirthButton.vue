<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-transparent border-2 border-[#0355B5] rounded-md font-semibold text-xs text-secondary tracking-widest focus:bg-transparent active:bg-transparent focus:outline-none focus:ring-2 focus:ring-[#0355B5]focus:ring-offset-2 transition ease-in-out duration-200 disabled:opacity-25 disabled:cursor-not-allowed">
        <slot />
    </button>
</template>

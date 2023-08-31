<template>
    <div class="max-w-md mx-auto">
      <div class="input-container mb-4">
        <label
          class="input-placeholder text-gray-500"
          :class="{ 'active': isFocused || inputValue }"
        >
          Placeholder
        </label>
        <input
          v-model="inputValue"
          @focus="isFocused = true"
          @blur="isFocused = false"
          class="input-field border border-gray-300 p-2 w-full rounded-md focus:outline-none focus:border-blue-500"
          type="text"
          required
        />
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        inputValue: '',
        isFocused: false,
      };
    },
  };
  </script>
  
  <style scoped>
  .input-container {
    position: relative;
  }
  .input-placeholder {
    position: absolute;
    top: 50%;
    left: 8px;
    transform: translateY(-50%);
    transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
    pointer-events: none;
  }
  .input-placeholder.active {
    transform: translateY(-150%) scale(0.75);
    color: #000;
    border-color: #fff;
    z-index: 900;
  }
  </style>
  
<template>
    <nav class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <!-- Logo -->
          <div class="flex items-center">
            <a href="/" class="text-xl font-bold text-blue-500">
                <img src="https://villaguerrero.edomex.gob.mx/sites/villaguerrero.edomex.gob.mx/files/villaguerrero.png" alt="">
            </a>
          </div>
  
          <!-- Desktop Menu -->
          <div class="hidden md:flex items-center space-x-4">
            <a href="/" class="text-gray-700 hover:text-blue-500">Inicio</a>
            <a href="/" class="text-gray-700 hover:text-blue-500">Noticias</a>
            <a href="/" class="text-gray-700 hover:text-blue-500">Offertas de trabajo</a>
            <a href="/" class="text-gray-700 hover:text-blue-500">Contacto</a>
          </div>
  
          <!-- Mobile Menu Button -->
          <div class="flex items-center md:hidden">
            <button @click="toggleMenu" class="text-gray-500 focus:outline-none focus:text-gray-700">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
              </svg>
            </button>
          </div>
        </div>
      </div>
  
      <!-- Mobile Menu -->
      <div v-if="isMenuOpen" class="md:hidden bg-gray-100">
        <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Inicio</a>
        <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Noticias</a>
        <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Offertas de trabajo</a>
        <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Contacto</a>
      </div>
    </nav>
  </template>
  
  <script>
  export default {
    name: "Navbar",
    data() {
      return {
        isMenuOpen: false, // Controla la visibilidad del menú móvil
      };
    },
    methods: {
      toggleMenu() {
        this.isMenuOpen = !this.isMenuOpen;
      },
    },
  };
  </script>
  
  <style scoped>
  /* Aquí puedes agregar estilos específicos para este componente */
  </style>
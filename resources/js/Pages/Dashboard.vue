<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <!-- Introducción -->
                    <section class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h1 class="text-3xl font-bold text-gray-800">Bienvenido al Dashboard de Administración</h1>
                        <p class="mt-4 text-gray-600">Este es el portal de administración de <strong>Villa Guerrero</strong>. Desde aquí, podrás gestionar el contenido del sitio, incluyendo las noticias, ofertas laborales.</p>
                        <p class="mt-2 text-gray-600">El sitio está diseñado para mantener a la comunidad informada sobre eventos, noticias locales y oportunidades de empleo, promoviendo la participación ciudadana y el desarrollo local.</p>
                    </section>

                    <section class="m-8">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Panel de Gestión</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <!-- Card: Gestionar Noticias -->
                            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <h3 class="text-xl font-bold text-gray-800">Gestionar Noticias</h3>
                                <p class="mt-4 text-gray-600">Administra las noticias locales que aparecerán en la página principal.</p>
                                <a href="/publicationsInternal" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Ir a Noticias</a>
                            </div>

                            <!-- Card: Gestionar Bolsa de Trabajo -->
                            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                <h3 class="text-xl font-bold text-gray-800">Gestionar Bolsa de Trabajo</h3>
                                <p class="mt-4 text-gray-600">Publica nuevas ofertas laborales y gestiona las existentes.</p>
                                <a href="/offersInternal" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Ir a Bolsa de Trabajo</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

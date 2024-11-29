<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
import moment from 'moment';

const config = {
    autoplay: 3000,
    pauseAutoplayOnHover: true,
};

// Define las propiedades que provienen del backend con defineProps
defineProps({
    publication: Object, // Declaramos que la propiedad es un objeto
});
</script>

<template>
    <Head :title="publication.title" />
    <NavBar />
    <div class="max-w-screen-lg mx-auto px-4 pt-5 gap-4">
        <!-- Título del artículo -->
        <h1 class="text-3xl font-bold text-gray-800">{{ publication.title }}</h1>
        <h2 class="text-2xl font-bold text-gray-800 mt-3">{{ publication.subtitle }}</h2>

        <!-- Información del autor y fecha -->
        <div class="flex items-center mt-4 text-gray-600">
            <div>
                <p class="text-sm">Publicado el 
                    <span> 
                        {{ moment(publication.startDate, "YYYY-MM-DD").format("DD MMM,YYYY") }}
                    </span>
                </p>
            </div>
        </div>
        <div class="mt-6 text-gray-700 leading-relaxed">
            <p class="mt-4">
            <div v-html="publication.description"></div>
            </p>
        </div>

        <div
            class="bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] rounded-xl flex max-w-xl flex-col items-start p-3 mx-auto justify-between dark:bg-slate-800">
            <carousel v-bind="config" :items-to-show="1.5">
                <slide v-for="image in publication.images" :key="image.id">
                    <img :src="image" alt="noticia" class="w-full h-64 object-cover">
                </slide>
                <template #addons>
                        <Navigation />
                        <Pagination />
                </template>
            </carousel>
        </div>
    </div>

</template>

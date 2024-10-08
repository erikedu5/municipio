
<script setup>
    import Checkbox from '@/Components/Checkbox.vue';
    import AppLayout from'@/Layouts/AppLayout.vue';
    import{ useForm }from'@inertiajs/vue3';
    import VueDatePicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css';
    import { ref } from 'vue';

    const props=defineProps({offer: Object});
    const previews = ref(props.offer !== undefined ? props.offer.images: []);

    const form = useForm({
        id: props.offer !== undefined ? props.offer.id: null,
        title: props.offer !== undefined ? props.offer.title : '',
        subtitle: props.offer !== undefined ? props.offer.subtitle : '',
        description: props.offer !== undefined ? props.offer.description : '',
        startDate: props.offer !== undefined ? new Date(props.offer.startDate) : new Date(),
        endDate: props.offer !== undefined ? new Date(props.offer.endDate) : new Date(),
        images: props.offer !== undefined ? props.offer.images :[]
    });

    const submit = () => {
        if (props.offer == null) {
            form.post(route('offersInternal.store'), form);
        } else {
            form.put(route('offersInternal.update', props.offer.id), form);
        }
    }

    const handleFileChange = (event) => {
      const selectedFiles = Array.from(event.target.files);
      form.images = selectedFiles;

      // Generar previews
      previews.value = selectedFiles.map(file => URL.createObjectURL(file));
    };

    const removeImage = (index) => {
      // Eliminar la imagen de los arrays
      previews.value.forEach(image => URL.revokeObjectURL(image)); // Liberar la URL
      previews.value.splice(index, 1);
      form.images.splice(index, 1);
    };

</script>

<template>
    <AppLayout title="CrearOferta">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Crear Oferta laboral
            </h2>
        </template>

        <hr class="my-6">
        <div class="flex">
            <div class="flex-none w-14 h-14">
            </div>
            <div class="grow h-14">
                <div class="md-col-span-2 mt-5 md:mt-0">
                    <div class="shadow bg-white md:rounded-md p-4">
                        <form @submit.prevent="submit">
                            <label class="block font-medium text-sm text-gray-700">Título</label>
                            <input type="text"
                                class="form-input w-full rounded-md shadow-sm"
                                v-model="form.title">
                            <br>
                            <br>

                            <label class="block font-medium text-sm text-gray-700">Subtítulo</label>
                            <input type="text"
                                class="form-input w-full rounded-md shadow-sm"
                                v-model="form.subtitle">
                            <br>
                            <br>

                            <label class="block font-medium text-sm text-gray-700">Descripción</label>
                            <textarea
                                class="form-input w-full rounded-md shadow-sm"
                                v-model="form.description"
                                rows="9">
                            </textarea>
                            <br>
                            <br>

                            <label class="block font-medium text-sm text-gray-700">Fecha de inicio</label>
                            <VueDatePicker v-model="form.startDate" :min-date="new Date()"></VueDatePicker>
                            <br>
                            <br>

                            <label class="block font-medium text-sm text-gray-700">Fecha de fin</label>
                            <VueDatePicker v-model="form.endDate" :min-date="new Date()"></VueDatePicker>
                            <br>
                            <br>

                            <label class="block font-medium text-sm text-gray-700">Imagenes</label>
                            <input type="file" @change="handleFileChange" multiple accept="image/*" />
                            <br>
                            <br>

                            <div class="preview">
                                <div v-for="(image, index) in previews" :key="index">
                                    <img :src="image" alt="Preview" />
                                    <br>
                                    <button  class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded
                                            hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700
                                            focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                            dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white"
                                            @click="removeImage(index)">Eliminar</button>
                                </div>
                            </div>
                            <br>
                            <br>

                            <button class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded
                                            hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700
                                            focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                            dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex-none w-14 h-14">
            </div>
        </div>
    </AppLayout>
</template>

<style>
    .preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .preview img {
        max-width: 100px; /* Ajusta según tus necesidades */
        max-height: 100px;
        border: 1px solid #ccc;
    }
</style>

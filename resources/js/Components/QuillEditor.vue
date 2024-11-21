<template>
    <div>
        <!-- Contenedor del editor -->
        <div id="editor" style="min-height: 150px;"></div>
    </div>
</template>

<script>
import { onMounted, ref, watch, nextTick } from 'vue';
import Quill from 'quill';
import 'quill/dist/quill.snow.css';

export default {
    name: 'QuillEditor',
    props: {
        modelValue: {
            type: String,
            default: '',
        },
    },
    emits: ['update:modelValue'],
    setup(props, { emit }) {
        const editor = ref(null);

        onMounted(() => {
            const editorContainer = document.querySelector('#editor');

            if (!editorContainer) {
                console.error('El contenedor #editor no está disponible.');
                return;
            }

            // Inicializar Quill
            editor.value = new Quill('#editor', {
                debug: 'info',
                modules: {
                    toolbar: true,
                },
                placeholder: 'Compose an epic...',
                theme: 'snow'
            });

            // // Insertar contenido inicial válido
            // const initialContent = props.modelValue || '<p><br></p>'; // Contenido seguro
            // editor.value.clipboard.dangerouslyPasteHTML(initialContent);

            // Escuchar cambios y emitirlos
            editor.value.on('text-change', () => {
                emit('update:modelValue', editor.value.root.innerHTML);
            });

            // Depurar cambios de selección
            // editor.value.on('selection-change', (range) => {
            //     console.log('Selection change:', range);
            //     if (!range) {
            //         console.warn('Selección inválida detectada.');
            //     }
            // });
        });

        // Actualizar contenido cuando `modelValue` cambie externamente
        watch(() => props.modelValue, (newValue) => {
            if (editor.value && editor.value.root.innerHTML !== newValue) {
                editor.value.clipboard.dangerouslyPasteHTML(newValue || '<p><br></p>');
            }
        });

        return {
            editor,
        };
    },
};
</script>
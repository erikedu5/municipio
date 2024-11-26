<template>
    <div class="quill-editor">
      <div ref="editor" class="quill-container"></div>
    </div>
</template>

<script>
  import { ref, onMounted, watch } from 'vue'
  import Quill from 'quill'
  import 'quill/dist/quill.snow.css' // Estilos predeterminados de Quill

  export default {
    name: 'QuillEditor',
    props: {
      modelValue: {
        type: String,
        default: ''
      }
    },
    setup(props, { emit }) {
      const editor = ref(null)
      const quillInstance = ref(null)

      // Inicializamos Quill al montar el componente
      onMounted(() => {
        quillInstance.value = new Quill(editor.value, {
          theme: 'snow',
          modules: {
            toolbar: [
              [{ header: '1' }, { header: '2' }, { font: [] }],
              [{ list: 'ordered' }, { list: 'bullet' }],
              ['bold', 'italic', 'underline'],
              ['link', 'image'],
              [{ align: [] }],
              ['blockquote', 'code-block'],
            ]
          }
        })

        // Sincronizamos el contenido del editor con el prop `modelValue`
        quillInstance.value.root.innerHTML = props.modelValue

        // Observamos los cambios en Quill y emitimos el valor actualizado al padre
        quillInstance.value.on('text-change', () => {
          const content = quillInstance.value.root.innerHTML
          emit('update:modelValue', content)
        })
      })

      // Verificamos si el contenido cambia desde el padre
      watch(() => props.modelValue, (newValue) => {
        if (quillInstance.value && newValue !== quillInstance.value.root.innerHTML) {
          quillInstance.value.root.innerHTML = newValue
        }
      })

      return { editor }
    }
  }
  </script>

  <style scoped>
  .quill-container {
    min-height: 300px;
  }
</style>

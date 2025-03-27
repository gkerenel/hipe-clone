<script setup lang="ts">
    import { ref, watch } from 'vue'

    const props = defineProps({
        id: {
            type: String,
            required: true
        },
        type: {
          type: String,
          required: false,
          default: 'text'
        },
        label: {
            type: String,
            required: true
        },
        placeholder: {
            type: String,
            required: true
        },
        modelValue: {
            type: String,
            required: true
        }
    })

    const emits = defineEmits(['update:modelValue'])

    const input_value = ref<string>(props.modelValue)

    watch(() => props.model, (new_input_value) => {
        input_value.value = new_input_value
    })

    const onInputUpdate = (event) => {
        emits('update:modelValue', event.target.value)
    }
</script>

<template>
    <div>
        <label :for="id" class="block text-sm font-medium text-hipe-1 mb-2">{{ label }}</label>
        <input :value="modelValue" @input="onInputUpdate" :type="type" required class="w-full px-4 py-3 rounded-lg text-hipe-2 border-2 border-hipe-s2/80 focus:border-hipe-s2/80 focus:outline-none focus:border-2" :placeholder="placeholder">
    </div>
</template>

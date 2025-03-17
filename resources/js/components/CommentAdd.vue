<script setup lang="ts">
    import { ref } from 'vue'

    defineProps({
        post_id: {
            required: true
        }
    })

    const comment = ref('')

    async function onSubmit() {

    }
</script>

<template>
    <div class="flex space-x-2 mt-2">
        <input v-model="comment" type="text" placeholder="Add a comment..." class="flex-1 border rounded px-2 py-1"/>
        <button @click="onSubmit" class="bg-blue-500 text-white px-4 py-1 rounded">Post</button>
    </div>
</template>

<script setup lang="ts">
    import { RouterLink } from 'vue-router'

    defineProps({
        long_description: {
            type: String,
            required: true
        },
        short_description: {
            type: String,
            required: true
        },
        url: {
            type: Object,
            required: true
        },
    })
</script>

<template>
    <nav class="bg-hipe-s1/20 backdrop-blur-md shadow-sm w-full">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center space-x-2">
                    <span class="text-hipe-1 material-symbols-outlined">mobile_hand</span>
                    <span class="text-hipe-1 text-3xl font-bold">Hipe</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-hipe-2">{{ long_description }}</span>
                    <RouterLink :to="url" class="text-hipe-1 hover:text-hipe-2 font-semibold">
                        {{ short_description }}
                    </RouterLink>
                </div>
            </div>
        </div>
    </nav>
</template>

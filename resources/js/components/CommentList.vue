<script setup lang="ts">
    import { useRouter } from 'vue-router'

    const router = useRouter()

    defineProps({
        comments: {
            type: Object,
            required: true
        }
    })
</script>

<template>
    <div v-for="comment in comments" :key="comment.id" class="border-b pb-2">
        <p>
            <span class="font-semibold text-blue-500 cursor-pointer hover:underline"
                  @click="router.push(`/dashboard/user/${comment.user.username}`)">
                {{ comment.user.name }}
            </span>: {{ comment.body }}
        </p>
    </div>
</template>

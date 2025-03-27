<script setup lang="ts">
    import {onMounted, ref} from 'vue'
    import Post from '@/components/Post.vue'
    import {PostApi} from '@/services/api/post'

    const posts = ref([])


    onMounted(async () => {
        const response = await PostApi.show()

        if (response.success) {
            posts.value = response.posts
        }
    })
</script>

<template>
    <main class="flex-1 p-8 h-min-screen">
        <div class="shadow rounded-lg p-3 space-y-6">
            <Post v-model="posts" />
        </div>
    </main>
</template>

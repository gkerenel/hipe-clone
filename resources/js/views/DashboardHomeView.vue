<script setup lang="ts">
    import { ref, onMounted } from 'vue'
    import { useRouter } from 'vue-router'
    import { PostApi } from '@/services/api/post'
    import CommentList from '@/components/CommentList.vue'
    import CommentAdd from '@/components/CommentAdd.vue'

    const posts = ref([])
    const router = useRouter()


    onMounted(async () => {
        const response = await PostApi.get()

        if (response.success) {
            posts.value = response.posts
        }
        else {

        }
    })

    async function toggleLike(post) {
        if (!post.isLiked) {
            post.likes_count += 1;
        } else {
            post.likes_count -= 1;
        }
        post.isLiked = !post.isLiked;
    }

    function toggleComments(post) {
        post.showComments = !post.showComments;
    }
</script>

<template>
    <main class="flex-1 p-8 h-min-screen">
        <div class="bg-white shadow rounded-lg p-3 space-y-6">
            <div
                v-if="posts"
                v-for="post in posts"
                :key="post.id"
                class="bg-gray-100 shadow-sm rounded-lg p-4 space-y-4"
            >
                <div class="flex items-center space-x-4">
                    <div
                        class="w-10 h-10 bg-blue-500 text-white flex items-center justify-center rounded-full text-lg font-bold"
                    >
                        {{ post.user.name.split(' ').map(n => n[0]).join('') }}
                    </div>
                    <div>
                        <h2 class="font-bold text-lg">@{{ post.user.username }}</h2>
                        <p class="text-gray-500 text-sm">Posted at {{ new Date(post.updated_at).toLocaleString() }}</p>
                    </div>
                </div>

                <!-- Post Body -->
                <p class="text-gray-700">{{ post.body }}</p>

                <!-- Actions -->
                <div class="flex items-center space-x-6">
                    <button
                        @click="toggleLike(post)"
                        :class="post.isLiked ? 'text-red-500' : 'text-gray-500'"
                        class="flex items-center space-x-1"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 4.248C8.852-1.443 0 1.36 0 8.14 0 14.366 12 22 12 22s12-7.634 12-13.86C24 1.36 15.148-1.443 12 4.248z"
                            />
                        </svg>
                        <span>{{ post.likes_count }}</span>
                    </button>
                    <button @click="toggleComments(post)" class="flex items-center text-blue-500 space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7H8.2L3 21l1.3-4.4a8.62 8.62 0 0 1-.3-2.1 8.5 8.5 0 1 1 17 0z" />
                        </svg>
                        <span>{{ post.comments.length }}</span>
                    </button>
                </div>

                <div v-if="post.showComments" class="space-y-4">
                    <CommentList :comments="post.comments" />
                    <CommentAdd :post_id="post.id" />
                </div>
            </div>
        </div>
    </main>
</template>

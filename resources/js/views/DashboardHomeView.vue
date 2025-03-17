<script setup lang="ts">
    import { ref, onMounted } from 'vue'
    import { useRouter } from 'vue-router'
    import {useAuthStore} from '@/stores/auth'
    import {postGet} from '@/services/api/post'

    const posts = ref([])
    const newComment = ref("")
    const router = useRouter()
    const token = useAuthStore().get()


    onMounted(async () => {

        const response = await postGet(token)
        posts.value = response.posts
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

function addComment(post) {
    if (newComment.value.trim() !== "") {
        post.comments.push({
            id: Date.now(),
            post_id: post.id,
            body: newComment.value,
            user: { id: 0, name: "You", username: "your_username" },
        });
        newComment.value = ""; // Clear input
    }
}

function goToUserProfile(username) {
    router.push(`/profile/${username}`);
}
</script>

<template>
    <main class="flex-1 p-8 h-min-screen">
        <div class="bg-white shadow rounded-lg p-3 space-y-6">
            <div
                v-for="post in posts"
                :key="post.id"
                class="bg-gray-100 shadow-sm rounded-lg p-4 space-y-4"
            >
                <!-- Post Header -->
                <div class="flex items-center space-x-4">
                    <div
                        class="w-10 h-10 bg-blue-500 text-white flex items-center justify-center rounded-full text-lg font-bold"
                    >
                        {{ post.user_id.toString().charAt(0) }}
                    </div>
                    <div>
                        <h2 class="font-bold text-lg">{{ post.user_id }}</h2>
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

                <!-- Comments -->
                <div v-if="post.showComments" class="space-y-4">
                    <div
                        v-for="comment in post.comments"
                        :key="comment.id"
                        class="border-b pb-2"
                    >
                        <p>
              <span
                  class="font-semibold text-blue-500 cursor-pointer hover:underline"
                  @click="goToUserProfile(comment.user.username)"
              >
                {{ comment.user.name }}
              </span>
                            : {{ comment.body }}
                        </p>
                    </div>
                    <div class="flex space-x-2 mt-2">
                        <input
                            v-model="newComment"
                            type="text"
                            placeholder="Add a comment..."
                            class="flex-1 border rounded px-2 py-1"
                        />
                        <button
                            @click="addComment(post)"
                            class="bg-blue-500 text-white px-4 py-1 rounded"
                        >
                            Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

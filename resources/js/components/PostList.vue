<template>
    <div>
        <button @click="openPostForm" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mb-8">
            Create New Post
        </button>
        <div v-for="post in posts" :key="post.id" class="bg-white p-6 rounded-lg shadow mb-4">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-gray-600 font-bold">{{ post.userId }}</span>
                    </div>
                    <div>
                        <h3 class="font-bold">{{ post.title }}</h3>
                        <p class="text-gray-500 text-sm">User {{ post.userId }}</p>
                    </div>
                </div>
                <div class="relative">
                    <button @click="togglePostMenu(post.id)" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>
                    <div v-if="activePostMenu === post.id" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
                        <button @click="editPost(post.id)" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Edit</button>
                        <button @click="deletePost(post.id)" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Delete</button>
                    </div>
                </div>
            </div>
            <p class="text-gray-700 mb-4">{{ post.body }}</p>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { useRouter } from 'vue-router';
import { fetchPosts, deletePost } from '@/services/api';

export default defineComponent({
    name: 'PostList',
    setup() {
        const router = useRouter();
        const posts = ref<any[]>([]);
        const activePostMenu = ref<number | null>(null);

        const loadPosts = async () => {
            posts.value = await fetchPosts();
        };

        const togglePostMenu = (postId: number) => {
            activePostMenu.value = activePostMenu.value === postId ? null : postId;
        };

        const editPost = (postId: number) => {
            router.push({ name: 'PostView', params: { id: postId } });
        };

        const deletePost = async (postId: number) => {
            await deletePost(postId);
            posts.value = posts.value.filter(post => post.id !== postId);
        };

        const openPostForm = () => {
            router.push({ name: 'PostView', params: { id: 'new' } });
        };

        loadPosts();

        return {
            posts,
            activePostMenu,
            togglePostMenu,
            editPost,
            deletePost,
            openPostForm,
        };
    },
});
</script>

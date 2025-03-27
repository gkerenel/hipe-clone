<script setup lang="ts">
    import CommentAdd from '@/components/CommentAdd.vue'
    import CommentList from '@/components/CommentList.vue'
    import { PostApi } from '@/services/api/post'
    import router from "@/router";
    import {onMounted, ref} from 'vue'
    import {ProfileApi} from "@/services/api/profile";
    import {User} from "@/interfaces/user";
    import {retryApi} from "@/services/utils/api";

    const props = defineProps({
        modelValue: {
            type: Array,
        }
    })

    const emits = defineEmits(['update:modelValue'])

    const user = ref<User>()

    const openMenu = ref(false)

    async function toggleLike(post) {
        post.is_liked = (await PostApi.postIsLiked(post.id)).success

        if (!post.is_liked) {
            if ((await PostApi.postLike(post.id)).success) {
                post.likes_count += 1;
            }
        } else {
            if ((await PostApi.postUnLike(post.id)).success)  {
                post.likes_count -= 1;
            }
        }
        post.is_liked = !post.is_liked;
    }

    function toggleMenu(postId) {
        if (openMenu.value === postId) {
            openMenu.value = null;
        } else {
            openMenu.value = postId;
        }
    }
    async function editPost(post_id) {
        await router.push({
            name: 'dashboard_post',
            params: {
                id: post_id
            }
        })
    }

    async function deletePost(id) {
        if ((await PostApi.delete(id)).success) {
            emits('update:modelValue', props.modelValue.filter(post => post.id != id))
        } else {

        }
    }

    function toggleComments(post) {
        post.showComments = !post.showComments;
    }

    function getRandomColor() {
        return  `#${Math.floor(Math.random() * 0xFFFFFF).toString(16).padStart(6, '0').toUpperCase()}`
    }

    onMounted(async () => {
        // const response = await retryApi(4, null)
        //
        // if (!response.success) {
        //     await router.push({name: 'index'})
        // }
        //
        //
        // user.value = response.user
    })
</script>

<template>
    <div v-if="modelValue" v-for="post in modelValue" :key="post.id" class="shadow-lg rounded-2xl p-4 bg-[#0F111A] border border-[#2E3044] shadow-lg transition-transform duration-300 hover:translate-y-[-3px] hover:shadow-xl">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div :style="{backgroundColor: getRandomColor()}" class="w-16 h-16 rounded-full flex items-center justify-center text-white text-xl font-bold">
                    {{ post.user?.name?.split(' ').map(n => n[0]).join('') ?? '??' }}
                </div>
                <div>
                    <h2 v-if="post.user.name" class="font-bold text-[#A4C2F4] mr-1 no-underline hover:underline">{{ post.user?.name }}</h2>
                    <a :href="`/dashboard/user/${post.user.username}`" class="text-[#E8E8E8] font-medium mr-1 no-underline hover:underline">@{{ post.user.username }}</a>
                    <p class="text-gray-500 text-sm">Posted at {{ new Date(post.created_at).toLocaleString() }} {{ (post.created_at == post.updated_at) ? '' : '(Edited)' }}</p>
                </div>
            </div>
            <div v-show="user?.id == post.user.id" class="relative">
                <button @click="toggleMenu(post.id)" class="cursor-pointer font-bold p-2 text-gray-600 hover:text-gray-800">
                    <span class="material-symbols-outlined">event_list</span>
                </button>
                <div v-if="openMenu == post.id" class="absolute right-0 mt-2 w-32 shadow-md rounded-lg border border-[#2e3344]">
                    <button @click="editPost(post.id, post.body)" class="block w-full text-left px-4 py-2 hover:bg-[#1A1C25]">Edit</button>
                    <button @click="deletePost(post.id)" class="block w-full text-left px-4 py-2 hover:bg-[#1A1C25] text-red-400">Delete</button>
                </div>
            </div>
        </div>
        <p class="text-[15px] text-[#A4C2F4] my-2.5 leading-relaxed">{{ post.body }}</p>
        <div class="flex items-center space-x-6">
            <button
                @click="toggleLike(post)"
                class="cursor-pointer flex items-center space-x-1"
            >
                <span :class="post.is_liked ? 'text-red-200' : ''" class="material-symbols-outlined text-[#2e3344]">favorite_border</span>
                <span>{{ post.likes_count }}</span>
            </button>
            <button @click="toggleComments(post)" class="cursor-pointer flex items-center text-blue-500 space-x-1">
                <span :class="post.comments.length ? 'text-[#4e89f5]' : ''" class="material-symbols-outlined text-[#2e3344]">chat_bubble</span>
                <span>{{ post.comments.length }}</span>
            </button>
        </div>

        <div v-if="post.showComments" class="space-y-4">
            <CommentList :current-user-id="post.user_id" :commentss="post.comments" />
            <CommentAdd :post_id="post.id" />
        </div>
    </div>
    <div v-else class="bg-hipe-s1 border border-hipe-s3  rounded-lg p-4 space-y-4">
        no have posts
    </div>
</template>

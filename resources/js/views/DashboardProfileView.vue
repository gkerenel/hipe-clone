<script setup lang="ts">
	import axios from 'axios'
	import { onMounted, ref } from 'vue'
	import router from '@/router'
	import { useAuthStore } from '@/stores/auth.ts'

	interface User {
		name: string;
		username: string;
		email: string;
		bio: string;
		followers_count: number;
		followings_count: number;
	}

    const posts = ref()

	const auth = useAuthStore()
	const user = ref<User | null>()

	onMounted(() => {
		axios.get('http://127.0.0.1:8000/api/user/profile', {
			headers: {
				'Authorization': `Bearer ${auth.getToken()}`,
			}
		})
		.then((response) => {
			user.value = response.data.user
		})
		.catch((error) => {
			console.log(error.response)
		})

        axios.get('http://127.0.0.1:8000/api/post', {
            headers: {
                'Authorization': `Bearer ${auth.getToken()}`,
            }
        })
            .then((response) => {
                if (response.data.posts.length == 0) {
                    post.value = 'posts will go here'
                }
                else {
                    posts.value = response.data.posts
                }
            })
            .catch((error) => {
                console.log(error.response)
            })
	})
</script>

<template>
	<main class="flex-1 p-8">
		<div class="bg-white shadow rounded-lg">
			<div class="relative">
				<div class="w-full h-48 bg-gray-300 rounded-t-lg"></div>
				<div class="absolute left-6 bottom-[-32px]">
					<div class="w-20 h-20 rounded-full border-4 border-white bg-gray-500 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">
                            {{ user?.name?.split(' ').map(n => n[0]).join('') }}
                        </span>
					</div>
				</div>
			</div>
			<div class="pt-10 px-6 pb-6">
				<div class="flex justify-between items-center">
					<div>
						<h2 class="text-3xl font-bold">{{ user?.name }}</h2>
						<p class="text-gray-600">@{{ user?.username }}</p>
					</div>
					<button @click="router.push('/dashboard/update')" class="px-5 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors">
						Edit Profile
					</button>
				</div>
				<p class="mt-4 text-gray-800">{{ user?.bio }}</p>
				<div class="mt-6 flex space-x-8">
					<div>
						<span class="font-bold text-xl">{{ user?.followers_count }}</span>
						<span class="text-gray-600 ml-1">Following</span>
					</div>
					<div>
						<span class="font-bold text-xl">{{ user?.followings_count }}</span>
						<span class="text-gray-600 ml-1">Following</span>
					</div>
				</div>
			</div>
			<div class="border-t border-gray-300 p-6">
				<p class="text-gray-700">
					{{ posts }}
				</p>
			</div>
		</div>
	</main>
</template>

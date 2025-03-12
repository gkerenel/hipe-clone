<script setup lang="ts">
	import { onMounted, ref } from 'vue'
	import axios from 'axios'
	import { SERVER_ROUTES } from '@/../env.d'
	import { useAuthStore } from '@/stores/auth.ts'
	import { useRoute } from 'vue-router'

	interface Gourmet {
		name: string;
		username: string;
		email: string;
		bio: string;
		banner: string;
		tasters_count: number;
		tastings_count: number;
	}

	const auth = useAuthStore()
	const gourmet = ref<Gourmet | null>()
	const route = useRoute()
	const username = route.params.username

	onMounted(() => {
		axios.get(`${SERVER_ROUTES.GET_OTHER_GOURMET}/${username}`, {
			headers: {
				'Authorization': `Bearer ${auth.getToken()}`,
			}
		})
			.then((response) => {
				console.log(response.data.gourmet)
				gourmet.value = response.data.gourmet
				console.log(gourmet.value)
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
				<div :style="{'backgroundImage': `url(${SERVER_ROUTES.IMAGE}/${gourmet?.banner})`}" class="w-full h-48 bg-blue-300 rounded-t-lg"></div>
				<div class="absolute left-6 bottom-[-32px]">
					<div
						class="w-20 h-20 rounded-full border-4 border-white bg-blue-500 flex items-center justify-center">
						<span class="text-white font-bold text-xl">{{ gourmet?.name?.split(' ').map(n => n[0]).join('') }}</span>
					</div>
				</div>
			</div>
			<div class="pt-10 px-6 pb-6">
				<div class="flex justify-between items-center">
					<div>
						<h2 class="text-3xl font-bold">{{ gourmet?.name }}</h2>
						<p class="text-gray-600">@{{ gourmet?.username }}</p>
					</div>
					<button class="px-5 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600">
						Follow
					</button>
				</div>
				<p class="mt-4 text-gray-800">{{ gourmet?.bio }}</p>
				<div class="mt-6 flex space-x-8">
					<div>
						<span class="font-bold text-xl">{{ gourmet?.tastings_count }}</span>
						<span class="text-gray-600 ml-1">Tastings</span>
					</div>
					<div>
						<span class="font-bold text-xl">{{ gourmet?.tasters_count }}</span>
						<span class="text-gray-600 ml-1">Tasteres</span>
					</div>
				</div>
			</div>
			<div class="border-t border-gray-300 p-6">
				<p class="text-gray-700">
					User tweets and content can be displayed here, taking advantage of the full available space.
				</p>
			</div>
		</div>
	</main>
</template>

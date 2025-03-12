<script setup lang="ts">
	import axios from 'axios'
	import { onMounted, ref, reactive } from 'vue'
	import router from '@/router'
	import { useAuthStore } from '@/stores/auth.ts'

	const user = reactive({
		name: '',
		username: '',
		email: '',
		bio: ''
	})

	const MAX_BIO_LENGTH = 255
	const auth = useAuthStore()
	const remaining = ref(MAX_BIO_LENGTH)

	function onBioInput() {
		if (user.bio.length > MAX_BIO_LENGTH) {
			user.bio = user.bio.slice(0, MAX_BIO_LENGTH)
		}

		remaining.value = MAX_BIO_LENGTH - user.bio.length;
	}

	async function onSubmit() {
		const form_data = {
            name: user.name,
            username: user.username,
            email: user.email,
            bio: user.bio,
        }

		axios.post('http://127.0.0.1:8000/api/user/profile', form_data, {
			headers: {
				'Authorization': `Bearer ${auth.getToken()}`
			},
		})
		.then(() => {
			router.push('/dashboard/profile')
		})
		.catch(() => {
		})
	}

	onMounted(() => {
		axios.get('http://127.0.0.1:8000/api/user/profile', {
				headers: {
					'Authorization': `Bearer ${auth.getToken()}`
				}
		})
		.then(async (response) => {
			const user_data = response.data.user;
			console.log(user_data)
			user.name = user_data?.name ?? ''
			user.username = user_data?.username ?? ''
			user.email = user_data?.email ?? ''
			user.bio = user_data?.bio ?? ''
			onBioInput()
		})
		.catch((error) => {
			console.error('Error loading user data:', error.response)
		})
	})
</script>


<template>
	<main class="flex-1 p-8 h-min-screen">
		<div class="bg-white shadow rounded-lg p-3">
			<div class="flex justify-between items-center mb-8">
				<div class="flex items-center space-x-4">
					<button @click="router.push('/dashboard/profile')" class="hover:bg-gray-200 rounded-full p-2">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
						</svg>
					</button>
					<h1 class="text-xl font-bold">Edit Profile</h1>
				</div>
				<button @click="onSubmit" class="bg-white text-black cursor-pointer px-4 py-2 rounded-full font-bold hover:bg-gray-200">Save</button>
			</div>
			<div class="space-y-6">
				<div class="bg-center bg-cover C bg-no-repeat relative h-48 bg-gray-200 rounded-xl">
					<input  type="file" id="cover" class="hidden" accept="image/*" />
					<label for="cover" class="absolute inset-0 flex items-center justify-center bg-white opacity-0 hover:opacity-100 transition cursor-pointer">
						<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
						</svg>
					</label>
				</div>
				<div class="relative -mt-16 ml-4 w-fit">
					<div class="w-20 h-20 rounded-full border-4 border-white bg-gray-500 flex items-center justify-center">
                        <span class="text-white font-bold text-xl">
                            {{ user.name.split(' ').map(n => n[0]).join('') }}
                        </span>
					</div>
				</div>
				<div class="space-y-6 p-2">
					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">Name</label>
						<input v-model="user.name" type="text" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter your name">
					</div>
					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">Username</label>
						<input v-model="user.username" type="text" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter your username">
					</div>
					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">Email</label>
						<input v-model="user.email" type="email" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter your email">
					</div>

					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">Bio</label>
						<textarea v-model="user.bio" @input="onBioInput" class="w-full bg-transparent focus:outline-none placeholder-gray-600 resize-none" rows="3" placeholder="Tell the world about yourself">
						</textarea>
						<div class="text-right text-sm text-gray-500 mt-2">{{ remaining }}/{{ MAX_BIO_LENGTH }} remaining</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</template>

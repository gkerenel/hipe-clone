<script setup lang="ts">
	import axios from 'axios'
	import { onMounted, ref, reactive } from 'vue'
	import router from '@/router'
	import { useAuthStore } from '@/stores/auth.ts'

	const user = reactive({
		new: '',
        new_confirmation: '',
		current: '',
	})

	const auth = useAuthStore()
	async function onSubmit() {
		const form_data = {
            new: user.username,
            new_confirmation: user.new_confirmation,
            current: user.current,
        }

		axios.post('http://127.0.0.1:8000/api/user/profile/password', form_data, {
			headers: {
				'Authorization': `Bearer ${auth.getToken()}`
			},
		})
		.then(() => {
			router.push('/dashboard/profile')
		})
		.catch((error) => {

            console.log(error.response)
		})
	}
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
					<h1 class="text-xl font-bold">Edit Password Profile</h1>
				</div>
				<button @click="onSubmit" class="bg-white text-black cursor-pointer px-4 py-2 rounded-full font-bold hover:bg-gray-200">Save</button>
			</div>
			<div class="space-y-6">
				<div class="space-y-6 p-2">
					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">New passowrd</label>
						<input v-model="user.new" type="text" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter new password">
					</div>
					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">New password confirmation</label>
						<input v-model="user.new_confirmation" type="text" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter new password confirmation">
					</div>
					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">Old password</label>
						<input v-model="user.current" type="email" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter old password">
					</div>
				</div>
			</div>
		</div>
	</main>
</template>

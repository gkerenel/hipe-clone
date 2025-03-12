<script setup lang="ts">
	import axios from 'axios'
	import { ref } from 'vue'
	import { useAuthStore } from '@/stores/auth.ts';
	import router from '@/router';

	const username = ref('')
	const password = ref('')
	const error = ref('')
	const submit = ref(false)

	async function onSubmit() {
		submit.value = true

		axios.post('http://127.0.0.1:8000/api/auth/signin', {
			username: username.value,
			password: password.value,
		})
			.then(response => {
				const token = response.data.token
				const auth = useAuthStore()
				auth.setToken(token)
				router.push('/dashboard')
			})
			.catch(reason => {
				console.log(reason)
				const errors = reason.response?.data?.errors
				error.value = errors?.join('\n')
				console.log(error.value)
				submit.value = false
			})
	}


</script>

<template>
	<form class="space-y-6" @submit.prevent="onSubmit">
		<div>
			<label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
			<input v-model="username" required type="text" class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 focus:border-blue-500 focus:outline-none focus:border-2" placeholder="Enter your username or email">
		</div>

		<div>
			<label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
			<input v-model="password" required type="password" class="w-full px-4 py-3 rounded-lg border-2 border-blue-200 focus:border-blue-500 focus:outline-none focus:border-2" placeholder="Create a password">
		</div>

		<button :disabled="submit"
				:class="{
			        'flex justify-center items-center cursor-not-allowed': submit,
					'cursor-pointer w-full bg-blue-500 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-600 transition-colors': true
			    }"
				type="submit">
			<svg v-if="submit" class="mr-3 -ml-1 h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
				<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
				<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
			</svg>
			<span>{{ submit ? 'Signing in...' : 'Sign In' }}</span>
		</button>
	</form>
</template>

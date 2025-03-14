<script setup lang="ts">
	import { onMounted, ref, reactive } from 'vue'
    import { useAuthStore } from '@/stores/auth.ts'
    import {profileInfo, profileUpdate} from '@/services/api/profile'
    import router from "@/router";

	const user = reactive({
		name: '',
		username: '',
		email: '',
		bio: ''
	})

    const errors = ref('')
    const errors_show = ref(false)

	const MAX_BIO_LENGTH = 255
	const auth = useAuthStore()
	const remaining = ref(MAX_BIO_LENGTH)

	function onBioInput() {
		if (user.bio.length > MAX_BIO_LENGTH) {
			user.bio = user.bio.slice(0, MAX_BIO_LENGTH)
		}

		remaining.value = MAX_BIO_LENGTH - user.bio.length;
	}

    function showError(error) {
        errors_show.value = true
        errors.value = error.join('\n')
        setTimeout(() => {
            errors_show.value = false
        }, 20000)
    }

	async function onSubmit() {
		const token = useAuthStore().get()
        const response = await profileUpdate(token, user.name, user.username, user.email, user.bio)

        if (response.success) {
            await router.push('/dashboard/profile')
        }
        else {
            showError(response.error)
        }
	}

    onMounted(async () => {
        const token = useAuthStore().get()
        const response = await profileInfo(token)

        if (response.success) {
            user.value = response.user
        }
        else {
            user.value = {
                name: "John Doe",
                username: "John Doe",
                email: "jane.doe@example.com",
                bio: 'this is error data',
            }
        }

        console.log(user.value)
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
                <pre v-show="errors_show" class="bg-red-400 w-full text-white p-2 mb-2">{{ errors }}</pre>
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

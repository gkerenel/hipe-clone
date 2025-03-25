<script setup lang="ts">
	import { onMounted, ref, reactive } from 'vue'
    import { ProfileApi } from '@/services/api/profile'
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
        const response = await ProfileApi.update(user.name, user.username, user.email, user.bio)

        if (response.success) {
            await router.push('/dashboard/profile')
        }
        else {
            showError(response.error)
        }
	}

    onMounted(async () => {
        const response = await ProfileApi.show()

        if (response.success) {
            user.name = response.user.name
            user.username = response.user.username
            user.email = response.user.email
            user.bio = response.user.bio
        }
        else {
            user.name = "John Doe"
            user.username = "John Doe"
            user.email = "jane.doe@example.com"
            user.bio = "this is error data"
        }
    })
</script>


<template>
	<main class="flex-1 p-8 h-min-screen">
		<div class="border border-[#2E3044] shadow rounded-lg p-3">
			<div class="flex justify-between items-center mb-8">
				<div class="flex items-center space-x-4">
					<button @click="router.push('/dashboard/profile')" class="hover:bg-[#1A1C25] p-2">
						<span class="material-symbols-outlined">arrow_back</span>
					</button>
					<h1 class="text-xl font-bold">Edit Profile</h1>
				</div>
                <button @click="router.push('/dashboard/update/password')" class="bg-[#2E3039] text-white border-none rounded px-4 py-2 cursor-pointer text-sm transition-colors duration-300 hover:bg-[#3a3f52]">Edit Password</button>
				<button @click="onSubmit" class="bg-[#4e89f5] text-white border-none rounded px-3 py-2 cursor-pointer text-sm transition-colors duration-300 hover:bg-[#357ae8]">Save</button>
			</div>
			<div class="space-y-6">
                <pre v-show="errors_show" class="bg-red-400 w-full text-white p-2 mb-2">{{ errors }}</pre>
				<div class="space-y-6 p-2">
					<div class="bg-[#151821] p-4 rounded-xl">
						<label class="block text-sm font-medium text-[#E8E8E8] mb-2">Name</label>
						<input v-model="user.name" type="text" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter your name">
					</div>
					<div class="bg-[#151821] p-4 rounded-xl">
						<label class="block text-sm font-medium text-[#E8E8E8] mb-2">Username</label>
						<input v-model="user.username" type="text" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter your username">
					</div>
					<div class="bg-[#151821] p-4 rounded-xl">
						<label class="block text-sm font-medium text-[#E8E8E8] mb-2">Email</label>
						<input v-model="user.email" type="email" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter your email">
					</div>

					<div class="bg-[#151821] p-4 rounded-xl">
						<label class="block text-sm font-medium text-[#E8E8E8] mb-2">Bio</label>
						<textarea v-model="user.bio" @input="onBioInput" class="w-full bg-transparent focus:outline-none placeholder-gray-600 resize-none" rows="3" placeholder="Tell the world about yourself">
						</textarea>
						<div class="text-right text-sm text-gray-500 mt-2">{{ remaining }}/{{ MAX_BIO_LENGTH }} remaining</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</template>

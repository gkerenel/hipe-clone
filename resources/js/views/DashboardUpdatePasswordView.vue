<script setup lang="ts">
    import { ProfileApi } from '@/services/api/profile'
    import { ref, reactive } from 'vue'
    import router from '@/router'

	const user = reactive({
        current: '',
        password_new: '',
        password_new_confirmation: '',
	})

    const errors = ref('')
    const errors_show = ref(false)

    function showError(errs) {
        errors_show.value = true
        errors.value = errs.join('\n')
        setTimeout(() => {
            errors_show.value = false
        }, 20000)
    }
	async function onSubmit() {
        const response = await ProfileApi.updatePassword(user.current, user.password_new, user.password_new_confirmation)

        if (response.success) {
            await router.push('/dashboard/profile')
        }
        else {
            showError(response.errors)
        }
	}
</script>

<template>
	<main class="flex-1 p-8 h-min-screen">
		<div class="bg-white shadow rounded-lg p-3">
			<div class="flex justify-between items-center mb-8">
				<div class="flex items-center space-x-4">
					<button @click="router.push('/dashboard/update')" class="hover:bg-gray-200 rounded-full p-2">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
						</svg>
					</button>
					<h1 class="text-xl font-bold">Edit Password Profile</h1>
				</div>
				<button @click="onSubmit" class="bg-white text-black cursor-pointer px-4 py-2 rounded-full font-bold hover:bg-gray-200">Save</button>
			</div>
			<div class="space-y-6">
                <pre v-show="errors_show" class="bg-red-400 w-full text-white p-2 mb-2">{{ errors }}</pre>
				<div class="space-y-6 p-2">
					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">Current password</label>
						<input v-model="user.current" type="text" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter current password">
					</div>
					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">New password</label>
						<input v-model="user.password_new" type="text" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter new password">
					</div>
					<div class="bg-gray-200 p-4 rounded-xl">
						<label class="block text-sm font-medium text-gray-500 mb-2">Password Confirmation</label>
						<input v-model="user.password_new_confirmation" type="email" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter password confirmation">
					</div>
				</div>
			</div>
		</div>
	</main>
</template>

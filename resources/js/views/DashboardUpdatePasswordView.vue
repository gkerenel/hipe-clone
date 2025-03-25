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
		<div class="border border-[#2E3044] rounded-lg p-3">
			<div class="flex justify-between items-center mb-8">
				<div class="flex items-center space-x-4">
					<button @click="router.push('/dashboard/update')" class="hover:bg-[#1A1C25] p-2">
                        <span class="material-symbols-outlined">arrow_back</span>
					</button>
					<h1 class="text-xl font-bold">Edit Password Profile</h1>
				</div>
				<button @click="onSubmit" class="bg-[#4e89f5] text-white border-none rounded px-3 py-2 cursor-pointer text-sm transition-colors duration-300 hover:bg-[#357ae8]">Save</button>
			</div>
			<div class="space-y-6">
                <pre v-show="errors_show" class="bg-red-400 w-full text-white p-2 mb-2">{{ errors }}</pre>
				<div class="space-y-6 p-2">
					<div class="bg-[#151821] p-4 rounded-xl">
						<label class="block text-sm font-medium text-[#E8E8E8] mb-2">Current password</label>
						<input v-model="user.current" type="password" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter current password">
					</div>
					<div class="bg-[#151821] p-4 rounded-xl">
						<label class="block text-sm font-medium text-[#E8E8E8] mb-2">New password</label>
						<input v-model="user.password_new" type="password" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter new password">
					</div>
					<div class="bg-[#151821] p-4 rounded-xl">
						<label class="block text-sm font-medium text-[#E8E8E8] mb-2">Password Confirmation</label>
						<input v-model="user.password_new_confirmation" type="password" class="w-full bg-transparent focus:outline-none placeholder-gray-600" placeholder="Enter password confirmation">
					</div>
				</div>
			</div>
		</div>
	</main>
</template>

<script setup lang="ts">
	import { useAuthStore } from '@/stores/auth.ts'
	import router from '@/router'
    import {AuthApi } from '@/services/api/auth'

	async function onSignout() {
		await AuthApi.signout()
        useAuthStore().clear()
        await router.push('/')
	}
</script>

<template>
	<main class="flex-1 p-8 h-min-screen">
        <div class="bg-white shadow rounded-lg p-3">
            <h1 class="text-lg font-bold">Are you sure you want to signout</h1>
            <div class="mt-5">
                <a @click="onSignout" class="flex items-center p-2 rounded hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    <span class="ml-4 text-lg">Sign Out</span>
                </a>
            </div>
        </div>
	</main>
</template>

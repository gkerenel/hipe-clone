<script setup lang="ts">
	import { useAuthStore } from '@/stores/auth.ts'
    import {AuthApi } from '@/services/api/auth'
	import router from '@/router'

	async function onSignout() {
		await AuthApi.signout()
        useAuthStore().clear()
        await router.push('/')
	}
</script>

<template>
	<main class="flex-1 p-8 h-min-screen">
        <div class="bg-[#0F111A] border-[#2E3044] rounded-lg p-3">
            <h1 class="text-lg font-bold">Are you sure you want to signout</h1>
            <div class="mt-5">
                <a @click="onSignout" class="flex cursor-pointer items-center p-2 rounded hover:bg-[#1A1C25]">
                    <span class="material-symbols-outlined text-[#2e3344]">person</span>
                    <span class="ml-4 text-lg">Sign Out</span>
                </a>
            </div>
        </div>
	</main>
</template>

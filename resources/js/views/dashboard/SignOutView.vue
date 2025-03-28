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
        <div class="bg-hipe-s1 border-2 border-hipe-s3 rounded-lg p-3">
            <h1 class="text-3xl font-bold">Are you sure you want to signout</h1>
            <div class="mt-5 w-[200px]">
                <a @click="onSignout" class="flex cursor-pointer items-center p-2 rounded hover:bg-hipe-s3">
                    <span class="material-symbols-outlined text-hipe-1">person</span>
                    <span class="ml-4 text-lg">Sign Out</span>
                </a>
            </div>
        </div>
    </main>
</template>

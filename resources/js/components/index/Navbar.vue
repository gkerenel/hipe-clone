<script setup lang="ts">
    import { RouterLink } from 'vue-router'
</script>

<template>
    <nav class="bg-hipe-1/20 backdrop-blur-md shadow-sm fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <div class="flex items-center space-x-2 cursor-pointer">
                    <span class="text-hipe-1 material-symbols-outlined">mobile_hand</span>
                    <span class="text-hipe-1 text-3xl font-bold">Hipe</span>
                </div>
                <div class="flex space-x-4 items-center">
                    <RouterLink :to="{name: 'auth_signin'}" class="text-hipe-1 focus:outline-none hover:text-hipe-2 transition-colors">
                        Sign In
                    </RouterLink>
                    <RouterLink :to="{name: 'auth_signup'}" class="bg-hipe-s1 text-hipe-1 hover:text-hipe-2 font-bold px-6 py-2 focus:outline-none rounded-full hover:bg-hipe-s3 transition-colors shadow-lg">
                        Get Started
                    </RouterLink>
                </div>
            </div>
        </div>
    </nav>
</template>

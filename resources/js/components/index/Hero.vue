<script setup lang="ts">
    import { RouterLink } from 'vue-router'
</script>

<template>
    <section class="h-screen pt-20 bg-gradient-to-br from-hipe-s1 to-hipe-s2 flex items-center">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-6xl font-bold text-hipe-1 mb-8 animate-fade-in-up">
                What's happening now
            </h1>
            <p class="text-xl text-hipe-2 90 mb-12 max-w-2xl mx-auto">
                Join the conversation. Follow your interests. Hear what people are talking about.
            </p>
            <div class="space-y-4">
                <RouterLink :to="{name: 'auth_signup'}" class="inline-block bg-hipe-s1 hover:bg-hipe-s3 text-hipe-1 hover:text-hipe-2 px-12 py-4 rounded-full text-lg font-semibold  transition-transform transform hover:scale-105 shadow-xl">
                    Create Account
                </RouterLink>
                <p class="text-hipe-2/80 text-sm mt-8">
                    Already have an account?
                    <RouterLink :to="{name: 'auth_signin'}" class="text-hipe-1 font-semibold hover:underline">
                        Sign in
                    </RouterLink>
                </p>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
    import { RouterLink } from 'vue-router'
</script>

<template>
    <aside class="w-56 border-r border-hipe-s3 p-6 flex flex-col justify-between fixed h-screen">
        <div>
            <div class="mb-8">
                <RouterLink :to="{name: 'dashboard_home'}" class="flex items-center space-x-2">
                    <span class="material-symbols-outlined">mobile_hand</span>
                    <span class="text-2xl font-bold">Hipe</span>
                </RouterLink>
            </div>
            <nav class="space-y-4">
                <RouterLink :to="{name: 'dashboard_home'}" activeClass="bg-hipe-s5" class="flex items-center p-2 rounded hover:bg-hipe-s3">
                    <span class="material-symbols-outlined">home</span>
                    <span class="ml-4 text-lg">Home</span>
                </RouterLink>
                <RouterLink :to="{name: 'dashboard_post'}" activeClass="bg-hipe-s5" class="flex items-center p-2 rounded hover:bg-hipe-s3">
                    <span class="material-symbols-outlined">add_circle</span>
                    <span class="ml-4 text-lg">Post</span>
                </RouterLink>
                <RouterLink :to="{name: 'dashboard_explore'}" activeClass="bg-hipe-s5" class="flex items-center p-2 rounded hover:bg-hipe-s3">
                    <span class="material-symbols-outlined">explore</span>
                    <span class="ml-4 text-lg">Explore</span>
                </RouterLink>
                <RouterLink :to="{name: 'dashboard_profile'}" activeClass="bg-hipe-s5" class="flex items-center p-2 rounded hover:bg-hipe-s3">
                    <span class="material-symbols-outlined">person</span>
                    <span class="ml-4 text-lg">Profile</span>
                </RouterLink>
            </nav>
        </div>
        <div>
            <RouterLink :to="{name: 'dashboard_signout'}" activeClass="bg-hipe-s5" class="flex items-center p-2 rounded hover:bg-hipe-s3">
                <span class="material-symbols-outlined">logout</span>
                <span class="ml-4 text-lg">Profile</span>
            </RouterLink>
        </div>
    </aside>
</template>

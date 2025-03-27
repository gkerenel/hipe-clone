<script setup lang="ts">
    import router from "@/router"

    async function goToUpdateProfile() {
        await router.push('/dashboard/update-profile')
    }
</script>

<template>
    <button @click="goToUpdateProfile()" class="bg-[#4e89f5] text-[#E8E8E8]  border-none rounded px-4 py-2 cursor-pointer text-sm transition-colors duration-300 hover:bg-[#357ae8]">
        Edit Profile
    </button>
</template>

<script setup lang="ts">
    import { UserApi } from '@/services/api/user'
    import { ref } from 'vue'

    const follow_status = ref<boolean>(false)

    const prop = defineProps({
        username: {
            type: String,
            required: true
        }
    })

    async function follow() {
        const username = prop.username

        if (follow_status.value) {
            await UserApi.unfollow(username)
            follow_status.value = false
        } else {
            await UserApi.follow(username)
            follow_status.value = true
        }
    }
</script>

<template>
    <button @click="follow()" class="bg-[#4e89f5] text-white border-none rounded px-3 py-2 cursor-pointer text-sm transition-colors duration-300 hover:bg-[#357ae8]">
        {{ follow_status ? "Unfollow" : "Follow" }}
    </button>
</template>

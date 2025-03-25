<script setup lang="ts">
    import { User } from '@/interfaces/user'
    import { onMounted, ref } from 'vue'

	import { useAuthStore } from '@/stores/auth.ts'
	import { useRoute } from 'vue-router'
    import {UserApi} from "@/services/api/user";

	const auth = useAuthStore()
	const user = ref<User>()
    const followStatus = ref<boolean>({});

    function getRandomColor() {
        return  `#${Math.floor(Math.random() * 0xFFFFFF).toString(16).padStart(6, '0').toUpperCase()}`
    }

    async function isFollow(username: string): Promise<boolean> {
        const response = await UserApi.isFollowing(username);
        return response.success;
    }

    async function follow(username:string) {
        if (followStatus.value[username]) {
            await UserApi.unfollow(username);
            followStatus.value = false;
        } else {
            await UserApi.follow(username);
            followStatus.value = true;
        }
    }



    onMounted(async () => {
        const route = useRoute()

        if (route.params.username) {
            const response = await UserApi.show(route.params.username)
            console.log(response)
            if (response.success) {

                user.value = response.user
                followStatus.value = await isFollow(user.value?.username);
            }
        }
    })
</script>

<template>
    <main class="flex-1 p-8">
        <div class="bg-[#0F111A] bg-opacity-95 border-[#2E3044] rounded-lg">
            <div class="relative">
                <div :style="{backgroundColor: getRandomColor()}" class="w-full h-48  rounded-t-lg"></div>
                <div class="absolute left-6 bottom-[-32px]">
                    <div :style="{backgroundColor: getRandomColor()}" class="w-20 h-20 rounded-full border-4 border-white flex items-center justify-center">
                        <span class="text-white font-bold text-xl">
                            {{ user?.name?.split(' ').map(n => n[0]).join('') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="pt-10 px-6 pb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold">{{ user?.name }}</h2>
                        <p class="text-gray-600">@{{ user?.username }}</p>
                    </div>
                    <button @click="follow(user?.username)" class="bg-[#4e89f5] text-white border-none rounded px-3 py-2 cursor-pointer text-sm transition-colors duration-300 hover:bg-[#357ae8]">
                        {{ followStatus ? "Unfollow" : "Follow" }}
                    </button>
                </div>
                <p class="mt-4 text-gray-800">{{ user?.bio }}</p>
                <div class="mt-6 flex space-x-8">
                    <div>
                        <span class="font-bold text-xl">{{ user?.followers_count }}</span>
                        <span class="text-gray-600 ml-1">Following</span>
                    </div>
                    <div>
                        <span class="font-bold text-xl">{{ user?.followings_count }}</span>
                        <span class="text-gray-600 ml-1">Following</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

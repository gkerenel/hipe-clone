<script setup lang="ts">
import {computed, onMounted, ref} from "vue";
    import {UserApi} from "@/services/api/user";
    import {User} from "@/interfaces/user";
    const users = ref<User[]>()
    const followStatus = ref<Record<string, boolean>>({});
    const isSearching = ref(false)

    const username = ref<string>('')

    async function onSubmit() {
        isSearching.value = true
        if (isSearching.value) {
            const response = await UserApi.search(username.value)

            if (response.success) {
                users.value = response.users
                await Promise.all(
                    response.users.map(async (user: User) => {
                        followStatus.value[user.username] = await isFollow(user.username);
                    })
                );
            }
        }

        isSearching.value = false
    }

    async function isFollow(username: string): Promise<boolean> {
        const response = await UserApi.isFollowing(username);
        return response.success;
    }


    async function follow(username:string) {
        if (followStatus.value[username]) {
            await UserApi.unfollow(username);
            followStatus.value[username] = false;
        } else {
            await UserApi.follow(username);
            followStatus.value[username] = true;
        }
    }

    function getRandomColor() {
        return  `#${Math.floor(Math.random() * 0xFFFFFF).toString(16).padStart(6, '0').toUpperCase()}`
    }

    onMounted(async () => {
    })
</script>

<template>
    <main class="flex-1 p-8">
        <div class=" border border-[#2E3044] p-4 rounded-xl">
            <input @input="onSubmit" v-model="username" type="text" class="w-full p-3 bg-[#0F111A] border border-[#2E3039] rounded-lg text-[#E0E0E0] mb-6" placeholder="Search users...">
        </div>
        <div>
            <div v-for="user in users" class="flex items-center space-x-4">
                <div :style="{backgroundColor: getRandomColor()}" class="w-16 h-16 rounded-full flex items-center justify-center text-white text-xl font-bold">
                    {{ user?.name?.split(' ').map(n => n[0]).join('') ?? '??' }}
                </div>
                <div>
                    <h2 v-if="user?.name" class="font-bold text-[#A4C2F4] mr-1 no-underline hover:underline">{{ user?.name }}</h2>
                    <a :href="`/dashboard/user/${user?.username}`" class="text-[#E8E8E8] font-medium mr-1 no-underline hover:underline">@{{ user?.username }}</a>
                    <button @click="follow(user?.username)" class="bg-[#4e89f5] text-white border-none rounded px-3 py-2 cursor-pointer text-sm transition-colors duration-300 hover:bg-[#357ae8]">
                        {{ followStatus[user.username] ? "Unfollow" : "Follow" }}
                    </button>
                </div>
            </div>
        </div>
        <button @click="onSubmit" class="mt-4 bg-[#4e89f5] text-white border-none rounded px-4 py-2 cursor-pointer text-sm transition-colors duration-300 hover:bg-[#357ae8]">{{ isSearching ? 'Searching...' : 'Search User' }}</button>
    </main>
</template>

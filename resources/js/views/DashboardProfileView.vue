<script setup lang="ts">
	import { onMounted, ref } from 'vue'
	import router from '@/router'
    import { ProfileApi } from '@/services/api/profile'
	interface User {
		name: string;
		username: string;
		bio: string;
		followers_count: number;
		followings_count: number;
	}
    function getRandomColor() {
        const letters = "0123456789ABCDEF"
        let color = "#"

        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)]
        }
        return color
    }

    const posts = ref()
	const user = ref<User | null>()

	onMounted(async () => {
        const response = await ProfileApi.getInfo()

        if (response.success) {
            user.value = response.user
        }
        else {
            user.value = {
                name: "John Doe",
                username: "John Doe",
                email: "jane.doe@example.com",
                bio: 'this is error data',
                followers_count: -1,
                followings_count: -1
            }
        }
	})
</script>

<template>
	<main class="flex-1 p-8">
		<div class="bg-white shadow rounded-lg">
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
					<button @click="router.push('/dashboard/update')" class="px-5 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors">
						Edit Profile
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
			<div class="border-t border-gray-300 p-6">
				<p class="text-gray-700">
					{{ posts }}
				</p>
			</div>
		</div>
	</main>
</template>

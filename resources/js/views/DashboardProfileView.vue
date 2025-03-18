<script setup lang="ts">
    import { ProfileApi } from '@/services/api/profile'
    import { PostApi } from '@/services/api/post'
    import { User } from '@/interfaces/user'
    import { Post as PostInterface } from '@/interfaces/post'
    import Post from '@/components/Post.vue'
    import { onMounted, ref } from 'vue'
    import router from '@/router'

    const posts = ref<PostInterface[]>()
    const user = ref<User>()

    function getRandomColor() {
        return  `#${Math.floor(Math.random() * 0xFFFFFF).toString(16).padStart(6, '0').toUpperCase()}`
    }

	onMounted(async () => {
        const responseUser = await ProfileApi.show()
        const responsePosts = await PostApi.show()

        user.value =
            responseUser.success ?
                responseUser.user :
                { name: "error", username: "error", email: "error", bio: 'error', followers_count: -1, followings_count: -1 }

        posts.value = responsePosts.success ?
                responsePosts.posts :
                []
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
            <div v-if="posts" class="bg-white shadow rounded-lg p-3 space-y-6">
                <Post :posts="posts" />
            </div>
            <div v-else class="bg-white shadow rounded-lg p-8 space-y-6">
                <h2 class="font-bold">you have no posts</h2>
            </div>
		</div>
	</main>
</template>

<script setup lang="ts">
    import {onMounted} from "vue";
    import axios from "axios";
    import {useAuthStore} from "@/stores/auth";
    const auth = useAuthStore()
    onMounted(() => {
        axios.get('/api/notifications',
            {
                headers: {
                    'Authorization': `Bearer ${auth.getToken()}`
                }
            }
        )
            .then((response) => {
                console.log(response.data)
            })
    })
</script>

<template>
	<main class="flex-1 p-8">
		<div class="bg-white shadow rounded-lg">
			<div class="border-b border-gray-300 p-6">
				<h2 class="text-2xl font-bold">Notifications</h2>
			</div>
			<div class="p-6 space-y-4">
				<div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg bg-blue-50 border-l-4 border-blue-500 hover:bg-blue-100 transition-colors">
					<div class="flex items-start">
						<div class="flex-shrink-0">
							<div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center">
								<span class="text-white font-bold">JD</span>
							</div>
						</div>
						<div class="ml-4">
							<p class="text-gray-700">
								<span class="font-semibold">@johndoe</span> liked your tweet.
							</p>
							<span class="text-sm text-gray-500">2h ago</span>
						</div>
					</div>
					<button class="ml-4 text-gray-500 hover:text-red-500 transition-colors">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5-4h4a1 1 0 0 1 1 1v2H9V4a1 1 0 0 1 1-1z" />
						</svg>
					</button>
				</div>
				<div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
					<div class="flex items-start">
						<div class="flex-shrink-0">
							<div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
								<span class="text-white font-bold">JD</span>
							</div>
						</div>
						<div class="ml-4">
							<p class="text-gray-700">
								<span class="font-semibold">@janedoe</span> started following you.
							</p>
							<span class="text-sm text-gray-500">4h ago</span>
						</div>
					</div>
					<button class="ml-4 text-gray-500 hover:text-red-500 transition-colors">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5-4h4a1 1 0 0 1 1 1v2H9V4a1 1 0 0 1 1-1z" />
						</svg>
					</button>
				</div>
				<div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg bg-blue-50 border-l-4 border-blue-500 hover:bg-blue-100 transition-colors">
					<div class="flex items-start">
						<div class="flex-shrink-0">
							<div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center">
								<span class="text-white font-bold">AL</span>
							</div>
						</div>
						<div class="ml-4">
							<p class="text-gray-700">
								<span class="font-semibold">@alice</span> commented on your post.
							</p>
							<span class="text-sm text-gray-500">1d ago</span>
						</div>
					</div>
					<button class="ml-4 text-gray-500 hover:text-red-500 transition-colors">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5-4h4a1 1 0 0 1 1 1v2H9V4a1 1 0 0 1 1-1z" />
						</svg>
					</button>
				</div>
			</div>
		</div>
	</main>
</template>

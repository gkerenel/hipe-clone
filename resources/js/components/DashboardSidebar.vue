<script setup lang="ts">
import twitterIcon from '@/assets/twitter.svg'
</script>

<template>
	<aside class="w-56 bg-white border-r border-gray-200 p-6 flex flex-col justify-between fixed h-screen">
		<div>
			<div class="mb-8">
				<a href="#" class="flex items-center space-x-2">
					<img :src="twitterIcon" alt="" class="w-8 h-8 focus:outline-none">
					<span class="text-2xl font-bold text-gray-900">Twitter</span>
				</a>
			</div>
			<nav class="space-y-4">
				<a href="/dashboard" class="flex items-center p-2 rounded hover:bg-gray-200">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-500">
						<path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
					</svg>
					<span class="ml-4 text-lg">Home</span>
				</a>
                <a href="/dashboard/post" class="flex items-center p-2 rounded hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                    <span class="ml-4 text-lg">Post</span>
                </a>
				<a href="/dashboard/profile" class="flex items-center p-2 rounded hover:bg-gray-200">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-500">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
					</svg>
					<span class="ml-4 text-lg">Profile</span>
				</a>
			</nav>
		</div>
		<div>
			<a href="/dashboard/signout" class="flex items-center p-2 rounded hover:bg-gray-200">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-blue-500">
					<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
				</svg>
				<span class="ml-4 text-lg">Sign Out</span>
			</a>
		</div>
	</aside>
</template>

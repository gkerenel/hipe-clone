<script setup lang="ts">
import twitterIcon from '@/assets/twitter.svg'
</script>

<template>
	<aside class="w-56 border-r border-[#2E3039] p-6 flex flex-col justify-between fixed h-screen">
		<div>
			<div class="mb-8">
				<a href="#" class="flex items-center space-x-2">
					<span class="material-symbols-outlined">mobile_hand</span>
					<span class="text-2xl font-bold text-[#A4C2F4]">Hipe</span>
				</a>
			</div>
			<nav class="space-y-4">
				<a href="/dashboard" class="flex items-center p-2 rounded hover:bg-[#1A1C25]">
                    <span class="material-symbols-outlined text-[#2e3344]">home</span>
					<span class="ml-4 text-lg">Home</span>
				</a>
                <a href="/dashboard/post" class="flex items-center p-2 rounded hover:bg-[#1A1C25]">
                    <span class="material-symbols-outlined text-[#2e3344]">add_circle</span>
                    <span class="ml-4 text-lg">Post</span>
                </a>
                <a href="/dashboard/explore" class="flex items-center p-2 rounded hover:bg-[#1A1C25]">
                    <span class="material-symbols-outlined text-[#2e3344]">explore</span>
                    <span class="ml-4 text-lg">Explore</span>
                </a>
				<a href="/dashboard/profile" class="flex items-center p-2 rounded hover:bg-[#1A1C25]">
                    <span class="material-symbols-outlined text-[#2e3344]">person</span>
                    <span class="ml-4 text-lg">Profile</span>
				</a>
			</nav>
		</div>
		<div>
			<a href="/dashboard/signout" class="flex items-center p-2 rounded hover:bg-[#1A1C25]">
                <span class="material-symbols-outlined h-6 w-6 text-[#2e3344]">logout</span>
				<span class="ml-4 text-lg">Sign Out</span>
			</a>
		</div>
	</aside>
</template>
